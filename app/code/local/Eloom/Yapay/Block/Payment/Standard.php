<?php

##eloom.licenca##

class Eloom_Yapay_Block_Payment_Standard extends Mage_Payment_Block_Form {

  protected function _construct() {
    $this->setTemplate('eloom/yapay/payment/standard.phtml');
    parent::_construct();
  }

  protected function _prepareLayout() {
    return parent::_prepareLayout();
  }

  public function listJsonErrors() {
    return Mage::helper('core')->jsonEncode(Eloom_Yapay_Errors::listAll());
  }

  public function getToken() {
    return Mage::helper('eloom_yapay/config')->getToken();
  }

	public function isInProduction() {
		return Mage::helper('eloom_yapay/config')->isInProduction();
	}
}
