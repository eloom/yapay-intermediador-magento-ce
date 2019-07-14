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

      switch ($response->getStatusId()) {
        case Eloom_Yapay_Enum_Transaction_Status::AGUARDANDO_PAGAMENTO:
	      case Eloom_Yapay_Enum_Transaction_Status::EM_MONITORAMENTO:
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

	      case Eloom_Yapay_Enum_Transaction_Status::CANCELADA:
		      $order->getPayment()->setCcStatus(Eloom_Yapay_Enum_Transaction_Status::CANCELADA);
		      $order->getPayment()->save();

		      Mage::dispatchEvent('eloom_yapay_cancel_order', array('order' => $order, 'comment' => 'Falha no Pagamento.'));
		      $this->_redirect('checkout/onepage/failure', array('_secure' => true));

		      break;
      }
    } catch (Eloom_Yapay_UnprocessableEntityException $e) {
      $this->logger->fatal($e->getCode() . ' - ' . $e->getMessage());

      $order->getPayment()->setCcStatus(Eloom_Yapay_Enum_Transaction_Status::NOT_FOUND);
      $order->getPayment()->setCcDebugResponseBody(json_encode($e->getErrors()));
      $order->getPayment()->save();

	    $url = Mage::helper('eloom_yapay')->generateWebCheckoutPaymentLink($order->getIncrementId(), $order->getBaseGrandTotal());

	    // FIXME: ver com a Yapay o serviço de cancelamento
      //Mage::dispatchEvent('eloom_yapay_cancel_transaction', array('order' => $order, 'comment' => 'Falha no Pagamento.'));

	    Mage::getSingleton('core/session')->addError("<ul><li>" . implode("</li><li>", $e->getErrors()) . "</li></ul>");
      $this->_redirect($url, array('_secure' => true));
    } catch (\Exception $e) {
	    $this->logger->fatal($e->getCode() . ' - ' . $e->getMessage());

	    $order->getPayment()->setCcStatus(Eloom_Yapay_Enum_Transaction_Status::NOT_FOUND);
	    $order->getPayment()->setCcDebugResponseBody(json_encode($e->getMessage()));
	    $order->getPayment()->save();

	    Mage::dispatchEvent('eloom_yapay_cancel_transaction', array('token' => $order, 'transaction' => 'Falha no Pagamento.'));

	    Mage::getSingleton('checkout/session')->setErrorMessage("<ul><li>" . implode("</li><li>", array($e->getMessage())) . "</li></ul>");
	    $this->_redirect('checkout/onepage/failure', array('_secure' => true));
    }
  }

}
