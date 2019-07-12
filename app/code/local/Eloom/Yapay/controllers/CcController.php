<?php

##eloom.licenca##

class Eloom_Yapay_CcController extends Mage_Core_Controller_Front_Action {

  private $logger;

  /**
   * Initialize resource model
   */
  protected function _construct() {
    $this->logger = Eloom_Bootstrap_Logger::getLogger(__CLASS__);
    parent::_construct();
  }

  /**
   * Send expire header to ajax response
   *
   */
  protected function _expireAjax() {
    if (!Mage::getSingleton('checkout/session')->getQuote()->hasItems()) {
      $this->getResponse()->setHeader('HTTP/1.1', '403 Session Expired');
      exit;
    }
  }

  public function paymentAction() {
    $session = Mage::getSingleton('checkout/session');
    $order = Mage::getModel('sales/order')->loadByIncrementId($session->getLastRealOrderId());
    if ($order->getId() == '') {
      $this->_redirect('checkout/onepage/failure', array('_secure' => true));
      return;
    }

	  $response = null;
    try {
      $response = Mage::getModel('eloom_yapay/cc_request')->generatePaymentRequest($order);

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

      switch ($response->getStatusId()) {
        case Eloom_Yapay_Enum_Transaction_Status::AGUARDANDO_PAGAMENTO:
        case Eloom_Yapay_Enum_Transaction_Status::EM_PROCESSAMENTO:
	      case Eloom_Yapay_Enum_Transaction_Status::APROVADA:
          Mage::getSingleton('checkout/type_onepage')->getCheckout()->setLastSuccessQuoteId(true);
          if ($order->getCanSendNewEmailFlag() && !$order->getEmailSent()) {
            try {
              $order->sendNewOrderEmail();
            } catch (Exception $e) {
              $this->logger->fatal($e->getTraceAsString());
            }
          }
          $this->_redirect('checkout/onepage/success', array('_secure' => true));
          break;
      }
    } catch (Eloom_Yapay_UnprocessableEntityException $e) {
      $this->logger->fatal($e->getCode() . ' - ' . $e->getMessage());

      $order->getPayment()->setCcStatus(Eloom_Yapay_Enum_Transaction_Status::NOT_FOUND);
      $order->getPayment()->setCcDebugResponseBody(json_encode($e->getErrors()));
      $order->getPayment()->save();

      Mage::dispatchEvent('eloom_yapay_cancel_order', array('order' => $order, 'comment' => 'Falha no Pagamento.'));

      Mage::getSingleton('checkout/session')->setErrorMessage("<ul><li>" . implode("</li><li>", $e->getErrors()) . "</li></ul>");
      $this->_redirect('checkout/onepage/failure', array('_secure' => true));
    }
  }

}
