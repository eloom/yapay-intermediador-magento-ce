<?php

/**
 * Class Payment
 * @package Yapay\Domains\Requests
 */
class Eloom_Yapay_Domains_Requests_Authorization extends Request {

	/**
	 * @param $credentials
	 * @return string
	 * @throws \Exception
	 */
	public function register($credentials) {
		return Eloom_Yapay_Services_Application_Authorization::create($credentials, $this);
	}

}
