<?php

trait Eloom_Yapay_Domains_Requests_Shipping_Address {

	private $address;

	public function getAddress() {
		return current($this->address);
	}

	public function setAddress() {
		$this->address = new Eloom_Yapay_Resources_Factory_Shipping_Address($this->shipping);
		return $this->address;
	}

}
