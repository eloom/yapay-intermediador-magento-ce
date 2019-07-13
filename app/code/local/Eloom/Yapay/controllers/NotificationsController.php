<?php

##eloom.licenca##

class Eloom_Yapay_NotificationsController extends Mage_Core_Controller_Front_Action {

	private $logger;

	/**
	 * Initialize resource model
	 */
	protected function _construct() {
		$this->logger = Eloom_Bootstrap_Logger::getLogger(__CLASS__);
		parent::_construct();
	}

	public function indexAction() {
		$data = $this->getRequest()->getPost();

		if ($data && isset($data['transaction'])) {
			try {
				$transaction = $data['transaction'];
				$this->logger->info(sprintf("Notificação Yapay. Pedido [%s] | Token transaction [%s] | Status [%s]", $transaction['order_number'], $data['token_transaction'], $transaction['status_name']));

				$order = Mage::getModel('sales/order')->loadByIncrementId($transaction['order_number']);

				/**
				 * Conferir se não houve falha no pagamento, na validação de campos
				 */
				$tokenTransaction = $order->getPayment()->getTokenTransaction();
				$lastTransId = $order->getPayment()->getLastTransId();

				if(empty($tokenTransaction) || empty($lastTransId)) {
					$order->getPayment()->setTokenTransaction($data['token_transaction']);
					$order->getPayment()->setLastTransId($transaction['transaction_id']);

					$order->getPayment()->save();
				}

				Mage::getModel('eloom_yapay/transaction_code')->synchronizeTransaction($transaction['seller_token'], $order->getPayment(), $order);
				$this->getResponse()->setHttpResponseCode(200);
			} catch(Exception $e) {
				$this->logger->fatal($e->getCode() . ' - ' . $e->getMessage());
				$this->getResponse()->setHttpResponseCode(500);
			}
		}
	}
}
