<?php

trait Eloom_Yapay_Domains_Requests_DirectPayment_Customer {

	private $customer;

	public function setCustomer() {
		$this->customer = Eloom_Yapay_Helpers_InitializeObject::initialize($this->customer, 'Eloom_Yapay_Domains_DirectPayment_Customer');
		return new Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Customer($this->customer);
	}

	public function getCustomer() {
		return $this->customer;
	}

}
