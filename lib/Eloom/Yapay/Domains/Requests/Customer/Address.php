<?php

trait Eloom_Yapay_Domains_Requests_Customer_Address {

	private $address;

	public function getAddress() {
		return current($this->address);
	}

	public function setAddress() {
		$this->address = new Eloom_Yapay_Resources_Factory_Customer_Address($this->customer);
		return $this->address;
	}

}
