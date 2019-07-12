<?php

class Eloom_Yapay_Domains_Credentials {

	/**
	 * @var
	 */
	private $email;

	/**
	 * @var
	 */
	private $token;

	/**
	 * @var
	 */
	private $appId;

	/**
	 * @var
	 */
	private $appKey;

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @param string $token
	 */
	public function setToken($token) {
		$this->token = $token;
	}

	/**
	 * @return string
	 */
	public function getAppId() {
		return $this->appId;
	}

	/**
	 * @param string $appId
	 */
	public function setAppId($appId) {
		$this->appId = $appId;
	}

	/**
	 * @return string
	 */
	public function getAppKey() {
		return $this->appKey;
	}

	/**
	 * @param string $appKey
	 */
	public function setAppKey($appKey) {
		$this->appKey = $appKey;
	}

}
