<?php

/**
 * Class Shipping
 * @package Yapay\Resources\Factory\Request
 */
class Eloom_Yapay_Resources_Factory_Shipping_Cost {

	/**
	 * @var \Yapay\Domains\Shipping
	 */
	private $shipping;

	/**
	 * Shipping constructor.
	 */
	public function __construct($shipping) {
		$this->shipping = $shipping;
	}

	public function instance(Eloom_Yapay_Domains_ShippingCost $cost) {
		return $this->shipping->setCost($cost);
	}

	public function withParameters($cost) {
		$shipping = new Eloom_Yapay_Domains_ShippingCost();
		$this->shipping->setCost(
			$shipping->setCost($cost)
		);
		return $this->shipping;
	}

}
