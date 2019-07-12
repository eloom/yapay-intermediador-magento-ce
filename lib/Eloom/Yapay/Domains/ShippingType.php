<?php


/**
 * Class ShippingType
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_ShippingType {

	/**
	 * @var
	 */
	private $type;

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

}
