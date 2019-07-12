<?php

##eloom.licenca##

class Eloom_Yapay_Block_Adminhtml_System_Config_Form_Logger_Button extends Mage_Adminhtml_Block_System_Config_Form_Field {

	private $order = null;

	protected function _construct() {
		parent::_construct();
		$this->order = Mage::registry('current_order');
		$this->setTemplate('eloom/yapay/payment/logger/button.phtml');
	}

	protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {
		return $this->_toHtml();
	}

	public function getLoggerUrl() {
		if($this->order) {
			return Mage::helper('adminhtml')->getUrl('eloom_yapay/adminhtml_index/logger', array('order_id' => $this->order->getId()));
		}
	}

	public function getButtonHtml() {
		if(!$this->order) {
			return '';
		}
		$button = $this->getLayout()->createBlock('adminhtml/widget_button')
			->setData(array(
				'id' => 'yapay_logger',
				'label' => Mage::helper('eloom_yapay')->__('Get Logger'),
				'onclick' => 'javascript:yapayLogger(); return false;'
			));
		return $button->toHtml();
	}
}