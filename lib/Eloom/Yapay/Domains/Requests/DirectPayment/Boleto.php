<?php


/**
 * Class Payment
 * @package Yapay\Domains\Requests
 */
class Eloom_Yapay_Domains_Requests_DirectPayment_Boleto extends Eloom_Yapay_Domains_Requests_DirectPayment_Boleto_Request {

	/**
	 * @param $credentials
	 * @return string
	 * @throws \Exception
	 */
	public function register($credentials) {
		return Eloom_Yapay_Services_DirectPayment_Boleto::checkout($credentials, $this);
	}

}
