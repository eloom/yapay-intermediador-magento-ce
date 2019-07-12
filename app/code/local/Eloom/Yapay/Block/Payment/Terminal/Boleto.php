<?php

##eloom.licenca##

class Eloom_Yapay_Block_Payment_Terminal_Boleto extends Mage_Core_Block_Template {

	/**
	 * Instructions text
	 *
	 * @var string
	 */
	protected $_instructions;

  protected function _construct() {
    parent::_construct();
		$this->setTemplate('eloom/yapay/payment/terminal/boleto.phtml');
  }

	public function getGrandTotal() {
		return Mage::getSingleton('eloom_yapay/session')->getOrder()->getBaseGrandTotal();
	}

	/**
	 * Get instructions text from config
	 *
	 * @return string
	 */
	public function getInstructions() {
		if (is_null($this->_instructions)) {
			$this->_instructions = Mage::helper('eloom_yapay/config')->getBilletInstructions();
		}
		return $this->_instructions;
	}
}