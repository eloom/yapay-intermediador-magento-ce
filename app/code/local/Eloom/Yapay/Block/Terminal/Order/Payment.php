<?php

##eloom.licenca##

class Eloom_Yapay_Block_Terminal_Order_Payment extends Mage_Core_Block_Template {

	/**
	 * Getter
	 *
	 * @return float
	 */
	public function getBaseGrandTotal() {
		return (float)Mage::getSingleton('eloom_yapay/session')->getOrder()->getBaseGrandTotal();
	}
}
