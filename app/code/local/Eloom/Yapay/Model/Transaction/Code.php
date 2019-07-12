<?php

##eloom.licenca##

class Eloom_Yapay_Model_Transaction_Code extends Mage_Core_Model_Abstract {

  private $logger;

  /**
   * Initialize resource model
   */
  protected function _construct() {
    $this->logger = Eloom_Bootstrap_Logger::getLogger(__CLASS__);
  }

  public function synchronizeTransaction($token, $payment, $order) {
    if (empty($payment->getLastTransId())) {
      throw new InvalidArgumentException("Transação não encontrada.");
    }
    if ($order->isCanceled()) {
			if($this->logger->isDebugEnabled()) {
				$this->logger->debug(sprintf("Pedido [%s] está cancelado. Sistema irá cancelar o status do pagamento.", $order->getIncrementId()));
			}
      $payment->setCcStatus(Eloom_Yapay_Enum_Transaction_Status::CANCELADA);
      $payment->save();

      return true;
    }

    try {
	    $credentials = new Eloom_Yapay_Domains_AccountCredentials();
	    $credentials->setToken($token);

	    $response = Eloom_Yapay_Services_Transactions_Notification::check($credentials, $payment->getTokenTransaction());

	    if ($response->getStatusId()) {
		    if ($response->getStatusId() != Eloom_Yapay_Enum_Transaction_Status::AGUARDANDO_PAGAMENTO) {
			    $payment->setCcStatus($response->getStatusId());
			    $payment->save();

			    $order = Mage::getModel('sales/order')->load($payment->getParentId());
			    Mage::dispatchEvent('eloom_yapay_process_transaction', array('order' => $order, 'status' => $response->getStatusId()));
		    }
	    }

	    return true;
    } catch (Exception $e) {

    }

    return false;
  }

}
