<?php

##eloom.licenca##

class Eloom_Yapay_Model_Session extends Mage_Core_Model_Session_Abstract {

	/**
	 * Class constructor. Initialize session namespace
	 */
	public function __construct() {
		$namespace = 'eloom_yapay';
		$namespace .= '_' . (Mage::app()->getStore()->getWebsite()->getCode());

		$this->init($namespace);
		Mage::dispatchEvent('eloom_yapay_session_init', array('eloom_yapay_session' => $this));
	}

	/**
	 * Unset all data associated with object
	 */
	public function unsetAll() {
		parent::unsetAll();
	}
}
