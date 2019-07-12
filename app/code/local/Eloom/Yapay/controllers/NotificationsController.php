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

				$this->logger->info(sprintf("Processando notificação. Pedido Yapay [%s] - Status [%s].", $transaction['order_number'], $transaction['status_name']));

				$parentId = Mage::getModel('sales/order_payment')->load($transaction['order_number'], 'last_trans_id')->getParentId();
				$order = Mage::getModel('sales/order')->load($parentId);

				Mage::getModel('eloom_yapay/transaction_code')->synchronizeTransaction($transaction['seller_token'], $order->getPayment(), $order);
				$this->getResponse()->setHttpResponseCode(200);
			} catch(Exception $e) {
				$this->logger->fatal($e->getCode() . ' - ' . $e->getMessage());
				$this->getResponse()->setHttpResponseCode(500);
			}
		}
	}
}
