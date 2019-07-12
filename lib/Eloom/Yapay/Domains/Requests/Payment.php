<?php

/**
 * Class Payment
 * @package Yapay\Domains\Requests
 */
class Eloom_Yapay_Domains_Requests_Payment extends Eloom_Yapay_Domains_Requests_Checkout_Payment_Request {

	/**
	 * @param $credentials
	 * @param bool $onlyCode
	 * @return string
	 * @throws \Exception
	 */
	public function register($credentials, $onlyCode = false) {
		return Eloom_Yapay_Services_Checkout_Payment::checkout($credentials, $this, $onlyCode);
	}

}
