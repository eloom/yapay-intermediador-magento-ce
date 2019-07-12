<?php

/**
 * Class ShippingCost
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_ShippingCost {

	/**
	 * @var
	 */
	private $cost;

	/**
	 * @return mixed
	 */
	public function getCost() {
		return $this->cost;
	}

	/**
	 * @param mixed $cost
	 * @return ShippingCost
	 */
	public function setCost($cost) {
		$this->cost = $cost;
		return $this;
	}

}
