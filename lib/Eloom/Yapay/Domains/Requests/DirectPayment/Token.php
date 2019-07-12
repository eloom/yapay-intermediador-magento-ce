<?php

/**
 * Domain request class of Token
 *
 * @package Yapay\Domains\Requests\DirectPayment
 */
trait Eloom_Yapay_Domains_Requests_DirectPayment_Token {

	private $token;

	public function getToken() {
		return $this->token;
	}

	public function setToken($token) {
		$this->token = $token;
		return $this;
	}

}
