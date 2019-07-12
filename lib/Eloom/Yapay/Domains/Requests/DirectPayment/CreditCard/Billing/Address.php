<?php

trait Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard_Billing_Address {

	private $address;

	public function getAddress() {
		return current($this->address);
	}

	public function setAddress() {
		$this->address = new Eloom_Yapay_Resources_Factory_Request_DirectPayment_CreditCard_Billing_Address($this->billing);
		return $this->address;
	}

}
