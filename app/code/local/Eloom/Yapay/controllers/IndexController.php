<?php

##eloom.licenca##

class Eloom_Yapay_IndexController extends Mage_Core_Controller_Front_Action {

	private $logger;

	/**
	 * Initialize resource model
	 */
	protected function _construct() {
		$this->logger = Eloom_Bootstrap_Logger::getLogger(__CLASS__);
		parent::_construct();
	}

	public function installmentsAction() {
		if (!$this->getRequest()->isPost()) {
			//return;
		}
		$response = array('success' => true);
		$paymentMethod = $this->getRequest()->getParam('paymentMethod');
		$paymentMethodId = Eloom_Yapay_Enum_DirectPayment_Method::getPaymentMethodId($paymentMethod);

		if($paymentMethodId == null) {
			$response['success'] = false;
			$response['message'] = Mage::helper('eloom_yapay')->__('Credit Card not allowed.');
		} else {
			$amount = $this->getRequest()->getParam('amount');
			$installments = null;

			$config = Mage::helper('eloom_yapay/config');
			if ($config->isReceiptByAntecipacao()) {
				$installments = Mage::getModel('eloom_yapay/installments')->calculateInstallmentsByAntecipacao($paymentMethodId, $amount);
			} else {
				$installments = Mage::getModel('eloom_yapay/installments')->calculateInstallmentsByFluxo($amount);
			}

			$response['installments'] = $installments;
		}

		$this->getResponse()->setHeader('Content-type', 'application/json', true);
		$this->getResponse()->setBody(json_encode($response));
	}
}