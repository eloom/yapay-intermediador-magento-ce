<?php

/**
 * Class Customer
 * @package Yapay\Domains\Requests
 */
trait Eloom_Yapay_Domains_Requests_Customer {

	/**
	 * @var
	 */
	private $customer;

	/**
	 * @return Adapter\Customer
	 */
	public function setCustomer() {
		$this->customer = Eloom_Yapay_Helpers_InitializeObject::initialize($this->customer, 'Eloom_Yapay_Domains_Customer');
		return new Eloom_Yapay_Domains_Requests_Adapter_Customer($this->customer);
	}

	/**
	 * @return \Yapay\Domains\Customer
	 */
	public function getCustomer() {
		return $this->customer;
	}

}
