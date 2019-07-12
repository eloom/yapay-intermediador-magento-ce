<?php

/**
 * Class Shipping
 * @package Yapay\Resources\Factory\Request
 */
class Eloom_Yapay_Resources_Factory_Shipping_Type {

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

	public function instance(ShippingType $type) {
		return $this->shipping->setType($type);
	}

	public function withParameters($type) {
		$shipping = new Eloom_Yapay_Domains_ShippingType();
		$shipping->setType($type);
		$this->shipping->setType(
			$shipping
		);
		return $this->shipping;
	}

}
