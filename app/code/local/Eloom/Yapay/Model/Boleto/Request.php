<?php

##eloom.licenca##

class Eloom_Yapay_Model_Boleto_Request extends Mage_Core_Model_Abstract {

  private $logger;

  protected function _construct() {
    $this->logger = Eloom_Bootstrap_Logger::getLogger(__CLASS__);
  }

  public function generatePaymentRequest(Mage_Sales_Model_Order $order) {
	  $payment = $order->getPayment();
	  $additionalData = json_decode($payment->getAdditionalData());

  	$billingAddress = $order->getBillingAddress();
    $shippingAddress = null;
    if ($order->getIsVirtual()) {
      $shippingAddress = $order->getBillingAddress();
    } else {
      $shippingAddress = $order->getShippingAddress();
    }

	  $tokenAccount = Eloom_Yapay_Configuration_Configure::getAccountCredentials()->getToken();
	  $boleto = new Eloom_Yapay_Domains_Requests_DirectPayment_Boleto();
	  $boleto->setToken($tokenAccount);
	  $boleto->setFingerPrint($additionalData->fingerPrint);

	  $birthday = $order->getCustomerDob();
	  $birthday = Mage::getModel('core/date')->date('d/m/Y', strtotime($birthday));

	  /* ------- Extra amount ------- */
	  $addition = 0.00;
	  $discount = 0.00;
	  if ($order->getBaseDiscountAmount()) {
		  $discount += $order->getBaseDiscountAmount();
	  }
	  if ($order->getYapayBaseDiscountAmount()) {
		  $discount += $order->getYapayBaseDiscountAmount();
	  }
	  if ($order->getBaseAffiliateplusDiscount()) {
		  $discount += $order->getBaseAffiliateplusDiscount();
	  }
	  if ($order->getBaseTaxAmount()) {
		  $addition = $order->getBaseTaxAmount();
	  }
	  $amount = $addition + $discount;

	  /* Transaction */
	  $url = Mage::getUrl('eloomyapay/notifications', array('_secure' => true));
	  $boleto->setTransaction()->setUrlNotification($url);
	  $boleto->setTransaction()->setCustomerIp($order->getRemoteIp());
	  $boleto->setTransaction()->setPriceDiscount(round(abs($amount), 2));
	  $boleto->setTransaction()->setFree(sprintf("Pedido %s", $order->getIncrementId()));
	  $boleto->setTransaction()->setOrderNumber($order->getIncrementId());

	  /* Frete */
	  $boleto->setTransaction()->setShippingType($order->getShippingDescription());
	  $boleto->setTransaction()->setShippingPrice(round($order->getBaseShippingAmount(), 2));

	  /* Payment */
	  $boleto->setPayment()->setPaymentMethodId(Eloom_Yapay_Enum_DirectPayment_Method::BOLETO);

	  /* ------- itens ------- */
	  foreach($order->getAllItems() as $item) {
		  $qtd = $item->getQtyToInvoice();
		  $basePrice = round($item->getBasePrice(), 2);
		  if (!empty($qtd) && $basePrice > 0) {
			  $boleto->addItems()->withParameters(substr($item->getName(), 0, 255), $qtd, $basePrice, $item->getProductId(), $item->getSku(), null);
		  }
	  }
    /* ------- Expiração Boleto */
    $expiration = new DateTime('now +' . $config->getBilletExpiration() . ' day');

	  /* ------- Customer ------- */
	  $customerName = trim($order->getCustomerFirstname()) . ' ' . ($order->getCustomerMiddlename() != null ? trim($order->getCustomerMiddlename()) . ' ' : '') . trim($order->getCustomerLastname());
	  $boleto->setCustomer()->setName(substr($customerName, 0, 100));
	  $boleto->setCustomer()->setBirthDate($birthday);

	  $taxVat = preg_replace('/\D/', '', $order->getCustomerTaxvat());

	  if (strlen($taxVat) > 11) {
		  $boleto->setCustomer()->setDocument()->withParameters('CNPJ', $taxVat);
	  } else {
		  $boleto->setCustomer()->setDocument()->withParameters('CPF', $taxVat);
	  }
	  $telephone = preg_replace('/\D/', '', $billingAddress->getTelephone());
	  $areaCode = substr($telephone, 0, 2);
	  $phoneNumber = substr($telephone, 2);
	  $boleto->setCustomer()->setPhone()->withParameters($areaCode, $phoneNumber);
	  $boleto->setCustomer()->setEmail($order->getCustomerEmail());

	  /* ------- Shipping ------- */
	  $zipCode = preg_replace('/\D/', '', $shippingAddress->getPostcode());
	  $boleto->setShipping()->setAddress()->withParameters(
		  'D', substr($shippingAddress->getStreet(1), 0, 80), substr($shippingAddress->getStreet(2), 0, 20), substr($shippingAddress->getStreet(4), 0, 60), $zipCode, $shippingAddress->getCity(), $shippingAddress->getRegionCode(), $shippingAddress->getCountryModel()->getIso3Code(), substr($shippingAddress->getStreet(3), 0, 40)
	  );

	  /* ------- Billing ------- */
	  $zipCode = preg_replace('/\D/', '', $billingAddress->getPostcode());
	  $boleto->setBilling()->setAddress()->withParameters('B', substr($billingAddress->getStreet(1), 0, 80), substr($billingAddress->getStreet(2), 0, 20), substr($billingAddress->getStreet(4), 0, 60), $zipCode, $billingAddress->getCity(), $billingAddress->getRegionCode(), $billingAddress->getCountryModel()->getIso3Code(), substr($billingAddress->getStreet(3), 0, 40));

	  $credential = Eloom_Yapay_Configuration_Configure::getAccountCredentials();
	  $response = $boleto->register($credential);

	  /* Parse Response */
	  /* link boleto */
	  $additionalData = new stdClass();
	  $additionalData->yapayOrderId = $response->getOrderNumber();
	  $additionalData->paymentLink = $response->getPayment()->getUrlPayment();
	  $additionalData->barCode = $response->getPayment()->getLinhaDigitavel();

	  $order->getPayment()->setAdditionalData(json_encode($additionalData));
	  $order->getPayment()->setCcStatus($response->getStatusId());
	  $order->getPayment()->setLastTransId($response->getTransactionId());
	  $order->getPayment()->setTokenTransaction($response->getTokenTransaction());

	  // calcular data para cancelar boleto
	  $orderCreatedAt = $order->getCreatedAt();
	  $config = Mage::helper('eloom_yapay/config');
	  $dayOfWeek = date("w", strtotime($orderCreatedAt));
	  $incrementDays = null;

	  switch ($dayOfWeek) {
		  case 5: // Sexta-Feira
			  $incrementDays = $config->getBilletCancelOnFriday();
			  break;

		  case 6: // Sabado
			  $incrementDays = $config->getBilletCancelOnSaturday();
			  break;

		  default:
			  $incrementDays = $config->getBilletCancelOnSunday();
			  break;
	  }

	  $totalDays = $config->getBilletExpiration() + $incrementDays;
	  $cancellationDate = strftime("%Y-%m-%d %H:%M:%S", strtotime("$orderCreatedAt +$totalDays day"));
	  $order->getPayment()->setBoletoCancellation($cancellationDate);
	  $order->getPayment()->save();

	  Mage::dispatchEvent('eloom_yapay_process_transaction', array('order' => $order, 'status' => $response->getStatusId()));

	  return $response;
  }

}
