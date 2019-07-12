<?php

/**
 * Class Customer
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_PreApproval_Customer extends Eloom_Yapay_Domains_Customer {

	/**
	 *
	 * @var
	 *
	 */
	private $address;

	/**
	 *
	 * @return mixed
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 *
	 * @param mixed $address
	 * @return Customer
	 */
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}
}
