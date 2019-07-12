<?php

trait Eloom_Yapay_Domains_Requests_Customer_Ip {

	/**
	 * @return mixed
	 */
	public function getIp() {
		return $this->customer->ip;
	}

	/**
	 * @param mixed $email
	 * @return Customer
	 */
	public function setIp($ip) {
		$this->customer->setIp($ip);
		return $this;
	}

}
