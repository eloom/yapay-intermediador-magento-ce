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

	/**
	 *
	 *
	 * @param $token
	 * @param $payment
	 * @param $order
	 * @return bool
	 */
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

	    $response = Eloom_Yapay_Services_Transactions_Search::check($credentials, $payment->getTokenTransaction());

	    if($response && $response->getStatusId() && $response->getPayment()) {
				if(!$response->getPayment()->getPaymentMethodId()) { // deu erro de validação de campo e é preciso cancelar
					$response = Eloom_Yapay_Services_Transactions_Cancel::cancel($credentials, $payment->getLastTransId()); // FIXME: ver com a Yapay a URL de cancelamento que está dando 404
				} else {
					if ($response->getStatusId() != Eloom_Yapay_Enum_Transaction_Status::AGUARDANDO_PAGAMENTO) {
						$payment->setCcStatus($response->getStatusId());
						$payment->save();

						$order = Mage::getModel('sales/order')->load($payment->getParentId());
						Mage::dispatchEvent('eloom_yapay_process_transaction', array('order' => $order, 'status' => $response->getStatusId()));
					}
				}
	    }

	    return true;
    } catch (Exception $e) {

    }

    return false;
  }

}
