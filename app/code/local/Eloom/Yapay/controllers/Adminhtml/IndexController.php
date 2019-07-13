<?php

##eloom.licenca##

class Eloom_Yapay_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {

	public function loggerAction() {
		$orderId = $this->getRequest()->getParam('order_id');

		if ($orderId) {
			try {
				$order = Mage::getModel('sales/order')->load($orderId);
				$config = Mage::helper('eloom_yapay/config');

				$credentials = new Eloom_Yapay_Domains_AccountCredentials();
				$credentials->setToken($config->getToken());
				$response = Eloom_Yapay_Services_Transactions_Search::check($credentials, $order->getPayment()->getTokenTransaction());
			} catch(Exception $e) {
				$response = $e->getMessage();
			}

			$this->getResponse()->setHeader('Content-type', 'application/json', true);
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
		}
	}

	/**
	 * Sincroniza o pedido com a Yapay
	 */
	public function sincAction() {
		$orderId = $this->getRequest()->getParam('order_id');
		$result = null;

		if ($orderId) {
			try {
				$config = Mage::helper('eloom_yapay/config');

				$order = Mage::getModel('sales/order')->load($orderId);

				Mage::getModel('eloom_yapay/transaction_code')->synchronizeTransaction($config->getToken(), $order->getPayment(), $order);

				$result = $this->__('The Payment has been updated.');
			} catch(Exception $e) {
				$result = $this->__('The Payment has not been updated.');
			}

			$this->getResponse()->setHeader('Content-type', 'application/json', true);
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
		}
	}
}
