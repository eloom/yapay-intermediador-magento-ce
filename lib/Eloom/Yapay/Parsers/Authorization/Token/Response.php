<?php

/**
 * Class Response
 * @package Yapay\Parsers\Transaction
 */
class Eloom_Yapay_Parsers_Authorization_Token_Response {

	private $accessToken;

	/**
	 * @return mixed
	 */
	public function getAccessToken() {
		return $this->accessToken;
	}

	/**
	 * @param mixed $accessToken
	 * @return Eloom_Yapay_Parsers_Authorization_Token_Response
	 */
	public function setAccessToken($accessToken) {
		$this->accessToken = $accessToken;
		return $this;
	}
}
