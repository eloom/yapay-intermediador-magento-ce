<?php

trait Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard_Holder_Phone {

	private $phone;

	public function getPhone() {
		return current($this->phone);
	}

	public function setPhone() {
		$this->phone = new Eloom_Yapay_Resources_Factory_Request_DirectPayment_CreditCard_Holder_Phone($this->holder);
		return $this->phone;
	}

}
