<?php

trait Eloom_Yapay_Domains_Requests_Shipping {

	private $shipping;

	public function __construct() {
		$this->shipping = new Eloom_Yapay_Domains_Shipping();
	}

	public function setShipping() {
		return new Eloom_Yapay_Domains_Requests_Adapter_Shipping($this->shipping);
	}

	public function getShipping() {
		return $this->shipping;
	}

}
