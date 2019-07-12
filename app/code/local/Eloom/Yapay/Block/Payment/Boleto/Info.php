<?php

##eloom.licenca##

class Eloom_Yapay_Block_Payment_Boleto_Info extends Mage_Payment_Block_Info {

	protected function _construct() {
		parent::_construct();
		$this->setTemplate('eloom/yapay/payment/boleto/info.phtml');
	}

	/**
	 * Prepare credit card related payment info
	 *
	 * @param Varien_Object|array $transport
	 * @return Varien_Object
	 */
	protected function _prepareSpecificInformation($transport = null) {
		if (null !== $this->_paymentSpecificInformation) {
			return $this->_paymentSpecificInformation;
		}
		$helper = Mage::helper('eloom_yapay');
		$transport = parent::_prepareSpecificInformation($transport);
		$info = $this->getInfo();
		$data = array();

		$status = $info->getCcStatus();
		if (!empty($status)) {
			$data[$helper->__('Status')] = $helper->__('Transaction.Status.' . $status);
		}

		if ($lastTransactionId = $info->getLastTransId()) {
			$data[$helper->__('Yapay Transaction ID')] = $lastTransactionId;
		}

		$additionalData = json_decode($info->getAdditionalData());
		if (!empty($additionalData)) {
			if (isset($additionalData->yapayOrderId)) {
				$data[$helper->__('Yapay Order ID')] = $additionalData->yapayOrderId;
			}
			if (isset($additionalData->barCode)) {
				$data[$helper->__('Yapay Bar Code')] = $additionalData->barCode;
			}
		}

		// errors
		$errors = json_decode($info->getCcDebugResponseBody());
		if (!empty($errors)) {
			foreach($errors as $error) {
				$data[$helper->__('Error')] = $error;
			}
		}

		return $transport->setData(array_merge($data, $transport->getData()));
	}

	public function getBilletLink() {
		$info = $this->getInfo();
		$lastTransId = $info->getLastTransId();
		$config = Mage::helper('eloom_yapay/config');

		$status = $info->getOrder()->getStatus();
		if (!empty($lastTransId) && ($status == $config->getNewOrderStatus())) {
			$additionalData = json_decode($info->getAdditionalData());
			return $additionalData->paymentLink;
		}

		return null;
	}

	public function getSynchronizeButton() {
		$button = Mage::getSingleton('core/layout')->createBlock('eloom_yapay/adminhtml_system_config_form_sinc_button');

		return $button->toHtml();
	}

	public function getLoggerButton() {
		$button = Mage::getSingleton('core/layout')->createBlock('eloom_yapay/adminhtml_system_config_form_logger_button');

		return $button->toHtml();
	}

	public function getLoggerContainer() {
		$button = Mage::getSingleton('core/layout')->createBlock('eloom_yapay/adminhtml_system_config_form_logger_textarea');

		return $button->toHtml();
	}
}
