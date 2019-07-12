<?php

##eloom.licenca##

trait Eloom_Yapay_Domains_Requests_Customer_Phone {

	private $phone;

	public function getPhone() {
		return current($this->phone);
	}

	public function setPhone() {
		$this->phone = new Eloom_Yapay_Resources_Factory_Customer_Phone($this->customer);
		return $this->phone;
	}

}
