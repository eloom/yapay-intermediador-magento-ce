<?php

##eloom.licenca##

class Eloom_Yapay_Model_Cc_Request extends Mage_Core_Model_Abstract {

  private $logger;

  protected function _construct() {
    $this->logger = Eloom_Bootstrap_Logger::getLogger(__CLASS__);
  }

	public function generatePaymentRequest(Mage_Sales_Model_Order $order) {
		$payment = $order->getPayment();
		$additionalData = json_decode($payment->getAdditionalData());

		$helper = Mage::helper('eloom_yapay');

		if($additionalData->creditCardNumber == null || $additionalData->creditCardExpiry == null || $additionalData->creditCardHolderName == null || $additionalData->creditCardCvc == null) {
			throw new InvalidArgumentException($helper->__('Credit card can not be null.'));
		}

		$billingAddress = $order->getBillingAddress();
		$shippingAddress = null;
		if ($order->getIsVirtual()) {
			$shippingAddress = $order->getBillingAddress();
		} else {
			$shippingAddress = $order->getShippingAddress();
		}
		$config = Mage::helper('eloom_yapay/config');

		/* Credit Card Payment */
		$creditCard = new Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard();
		$creditCard->setToken($config->getToken());
		$creditCard->setFingerPrint($additionalData->fingerPrint);

		$taxVat = null;
		$phone = null;
		$birthday = null;
		if (isset($additionalData->creditCardHolderAnother) && $additionalData->creditCardHolderAnother == 1) {
			$taxVat = $additionalData->creditCardHolderCpf;
			$phone = $additionalData->creditCardHolderPhone;
			$birthday = $additionalData->creditCardHolderBirthDate;
		} else {
			$taxVat = $order->getCustomerTaxvat();
			$phone = $billingAddress->getTelephone();
			$birthday = $order->getCustomerDob();
			$birthday = Mage::getModel('core/date')->date('d/m/Y', strtotime($birthday));
		}
		$taxVat = preg_replace('/\D/', '', $taxVat);
		$phone = preg_replace('/\D/', '', $phone);

		$areaCode = substr($phone, 0, 2);
		$phoneNumber = substr($phone, 2);

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
		$creditCard->setTransaction()->setUrlNotification($url);
		$creditCard->setTransaction()->setCustomerIp($order->getRemoteIp());
		$creditCard->setTransaction()->setPriceDiscount(round(abs($amount), 2));
		$creditCard->setTransaction()->setFree(sprintf("Pedido %s", $order->getIncrementId()));
		$creditCard->setTransaction()->setOrderNumber($order->getIncrementId());

		/* Frete */
		$creditCard->setTransaction()->setShippingType($order->getShippingDescription());
		$creditCard->setTransaction()->setShippingPrice(round($order->getBaseShippingAmount(), 2));

		/* Payment */
		$creditCardNumber = Mage::helper('core')->decrypt($additionalData->creditCardNumber);
		$expiry = explode("/", trim($additionalData->creditCardExpiry));
		$month = trim($expiry[1]);
    $year = trim($expiry[0]);

		$paymentMethodId = Eloom_Yapay_Enum_DirectPayment_Method::getPaymentMethodId($payment->getCcType());
		$creditCard->setPayment()->setPaymentMethodId($paymentMethodId);
		$creditCard->setPayment()->setCardName(substr($additionalData->creditCardHolderName, 0, 50));
		$creditCard->setPayment()->setCardNumber($creditCardNumber);
		$creditCard->setPayment()->setCardExpdateMonth($month);
		$creditCard->setPayment()->setCardExpdateYear($year);
		$creditCard->setPayment()->setCardCvv($additionalData->creditCardCvc);
		$creditCard->setPayment()->setSplit($additionalData->installments);

		/* ------- itens ------- */
		foreach($order->getAllItems() as $item) {
			$qtd = $item->getQtyToInvoice();
			$basePrice = round($item->getBasePrice(), 2);
			if (!empty($qtd) && $basePrice > 0) {
				$creditCard->addItems()->withParameters(substr($item->getName(), 0, 255), $qtd, $basePrice, $item->getProductId(), $item->getSku(), null);
			}
		}

		/* ------- Customer ------- */
		$customerName = trim($order->getCustomerFirstname()) . ' ' . ($order->getCustomerMiddlename() != null ? trim($order->getCustomerMiddlename()) . ' ' : '') . trim($order->getCustomerLastname());
		$creditCard->setCustomer()->setName(substr($customerName, 0, 100));
		$creditCard->setCustomer()->setBirthDate($birthday);

		$taxVat = preg_replace('/\D/', '', $order->getCustomerTaxvat());

		if (strlen($taxVat) > 11) {
			$creditCard->setCustomer()->setDocument()->withParameters('CNPJ', $taxVat);
		} else {
			$creditCard->setCustomer()->setDocument()->withParameters('CPF', $taxVat);
		}
		$telephone = preg_replace('/\D/', '', $billingAddress->getTelephone());
		$areaCode = substr($telephone, 0, 2);
		$phoneNumber = substr($telephone, 2);
		$creditCard->setCustomer()->setPhone()->withParameters($areaCode, $phoneNumber);
		$creditCard->setCustomer()->setEmail($order->getCustomerEmail());

		/* ------- Shipping ------- */
		$zipCode = preg_replace('/\D/', '', $shippingAddress->getPostcode());
		$creditCard->setShipping()->setAddress()->withParameters(
			'D', substr($shippingAddress->getStreet(1), 0, 80), substr($shippingAddress->getStreet(2), 0, 20), substr($shippingAddress->getStreet(4), 0, 60), $zipCode, $shippingAddress->getCity(), $shippingAddress->getRegionCode(), $shippingAddress->getCountryModel()->getIso3Code(), substr($shippingAddress->getStreet(3), 0, 40)
		);

		/* ------- Billing ------- */
		$zipCode = preg_replace('/\D/', '', $billingAddress->getPostcode());
		$creditCard->setBilling()->setAddress()->withParameters('B', substr($billingAddress->getStreet(1), 0, 80), substr($billingAddress->getStreet(2), 0, 20), substr($billingAddress->getStreet(4), 0, 60), $zipCode, $billingAddress->getCity(), $billingAddress->getRegionCode(), $billingAddress->getCountryModel()->getIso3Code(), substr($billingAddress->getStreet(3), 0, 40));

		$credential = Eloom_Yapay_Configuration_Configure::getAccountCredentials();
		$response = $creditCard->register($credential);


		/* Parse Response */
		$additionalData = json_decode($order->getPayment()->getAdditionalData());
		$additionalData->creditCardNumber = null;
		$additionalData->creditCardCvc = null;

		$order->getPayment()->setCcStatus($response->getStatusId());
		$additionalData->yapayOrderId = $response->getOrderNumber();

		$order->getPayment()->setAdditionalData(json_encode($additionalData));
		$order->getPayment()->setLastTransId($response->getTransactionId());
		$order->getPayment()->setTokenTransaction($response->getTokenTransaction());
		$order->getPayment()->setCcDebugResponseBody('');
		$order->getPayment()->save();

		Mage::dispatchEvent('eloom_yapay_process_transaction', array('order' => $order, 'status' => $response->getStatusId()));

		return $response;
	}
}