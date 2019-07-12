<?php

/**
 * Class ApplicationCredentials
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_ApplicationCredentials implements Eloom_Yapay_Domains_Account_Credentials {

	/**
	 * @var
	 */
	private $appId;

	/**
	 * @var
	 */
	private $appKey;

	/**
	 * @var
	 */
	private $authorizationCode;

	/**
	 * ApplicationCredentials constructor.
	 * @param null $appId
	 * @param null $appKey
	 */
	public function __construct($appId = null, $appKey = null) {
		//Setting app id
		if (!is_null($appId)) {
			$this->setAppId($appId);
		}
		//Setting app key
		if (!is_null($appKey)) {
			$this->setAppKey($appKey);
		}
	}

	/**
	 * @return mixed
	 */
	public function getAppId() {
		return $this->appId;
	}

	/**
	 * @param mixed $appId
	 * @return AccountCredentials
	 */
	public function setAppId($appId) {
		$this->appId = $appId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAppKey() {
		return $this->appKey;
	}

	/**
	 * @param mixed $appKey
	 * @return AccountCredentials
	 */
	public function setAppKey($appKey) {
		$this->appKey = $appKey;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAuthorizationCode() {
		return $this->authorizationCode;
	}

	/**
	 * @param mixed $authorizationCode
	 * @return ApplicationCredentials
	 */
	public function setAuthorizationCode($authorizationCode) {
		$this->authorizationCode = $authorizationCode;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getAttributesMap() {
		return [
			'appId' => $this->getAppId(),
			'appKey' => $this->getAppKey(),
			'authorizationCode' => $this->getAuthorizationCode()
		];
	}

	/**
	 * @return string
	 */
	public function toString() {
		return sprintf(
			"ApplicationCredentials[ Email : %s , Token: %s ]", $this->getAppId(), $this->getAppKey()
		);
	}

}
