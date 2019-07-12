<?php

trait Eloom_Yapay_Domains_Requests_Customer_Hash {

	/**
	 * @return mixed
	 */
	public function getHash() {
		return $this->customer->hash;
	}

	/**
	 * @param mixed $email
	 * @return Customer
	 */
	public function setHash($hash) {
		$this->customer->setHash($hash);
		return $this;
	}

}
