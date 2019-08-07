<?php

/**
 * Domain request class of Token
 *
 * @package Yapay\Domains\Requests\DirectPayment
 */
trait Eloom_Yapay_Domains_Requests_DirectPayment_ResellerToken {

	private $resellerToken;

	public function getResellerToken() {
		return $this->resellerToken;
	}

	public function setResellerToken($resellerToken) {
		$this->resellerToken = $resellerToken;
		return $this;
	}

}
