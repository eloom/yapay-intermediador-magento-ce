<?php

##eloom.licenca##

class Eloom_Yapay_BoletoController extends Mage_Core_Controller_Front_Action {

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
    try {
      $response = Mage::getModel('eloom_yapay/boleto_request')->generatePaymentRequest($order);

      switch ($response->getStatusId()) {
	      case Eloom_Yapay_Enum_Transaction_Status::AGUARDANDO_PAGAMENTO:
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
