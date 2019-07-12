<?php

class Eloom_Yapay_Domains_Requests_Adapter_Shipping {

	use Eloom_Yapay_Domains_Requests_Shipping_Address;
	use Eloom_Yapay_Domains_Requests_Shipping_Cost;
	use Eloom_Yapay_Domains_Requests_Shipping_Type;

	private $shipping;

	public function __construct($shipping) {
		$this->shipping = $shipping;
	}

}
