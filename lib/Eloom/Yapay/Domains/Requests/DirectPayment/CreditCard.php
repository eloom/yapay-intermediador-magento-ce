<?php

##eloom.licenca##

class Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard extends Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard_Request {

	/**
	 * @param $credentials
	 * @return string
	 * @throws \Exception
	 */
	public function register($credentials) {
		return Eloom_Yapay_Services_DirectPayment_CreditCard::checkout($credentials, $this);
	}
}