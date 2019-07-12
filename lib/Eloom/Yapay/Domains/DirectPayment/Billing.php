<?php

class Eloom_Yapay_Domains_DirectPayment_Billing {

	/**
	 * *
	 * Billing address
	 *
	 * @see Address
	 */
	private $address;

	/**
	 *
	 * @return Address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 *
	 * @param Address $address
	 * @return Shipping
	 */
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}

}
