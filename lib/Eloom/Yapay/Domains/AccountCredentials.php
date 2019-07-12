<?php

/**
 * Class AccountCredentials
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_AccountCredentials implements Eloom_Yapay_Domains_Account_Credentials {

	/**
	 *
	 * @var
	 *
	 */
	private $token;

	/**
	 * AccountCredentials constructor.
	 *
	 * @param null|string $token
	 */
	public function __construct($token = null) {
		// Setting token
		if (!is_null($token)) {
			$this->setToken($token);
		}
	}

	/**
	 *
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 *
	 * @param string $token
	 * @return AccountCredentials
	 */
	public function setToken($token) {
		$this->token = $token;
		return $this;
	}

	/**
	 *
	 * @return array
	 */
	public function getAttributesMap() {
		return [
			'token' => $this->getToken()
		];
	}

	/**
	 *
	 * @return string
	 */
	public function toString() {
		return sprintf("AccountCredentials[Token: %s ]", $this->getToken());
	}
}
