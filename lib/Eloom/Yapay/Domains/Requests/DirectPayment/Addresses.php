<?php

trait Eloom_Yapay_Domains_Requests_DirectPayment_Addresses {

	private $addresses;

	public function setAddresses() {
		$this->addresses = Eloom_Yapay_Helpers_InitializeObject::initialize($this->addresses, 'Eloom_Yapay_Domains_Addresses');
		return new Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Addresses($this->addresses);
	}

	public function getAddresses() {
		return $this->addresses;
	}
}