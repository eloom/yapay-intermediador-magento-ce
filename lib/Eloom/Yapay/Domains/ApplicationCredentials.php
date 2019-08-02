<?php

/**
 * Class ApplicationCredentials
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_ApplicationCredentials implements Eloom_Yapay_Domains_Account_Credentials {

	/**
	 * @var
	 */
	private $resellerToken;

	/**
	 * @var
	 */
	private $consumerKey;

	/**
	 * @var
	 */
	private $consumerSecret;

	/**
	 * @return mixed
	 */
	public function getResellerToken() {
		return $this->resellerToken;
	}

	/**
	 * @param mixed $resellerToken
	 */
	public function setResellerToken($resellerToken) {
		$this->resellerToken = $resellerToken;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getConsumerKey() {
		return $this->consumerKey;
	}

	/**
	 * @param mixed $consumerKey
	 */
	public function setConsumerKey($consumerKey) {
		$this->consumerKey = $consumerKey;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getConsumerSecret() {
		return $this->consumerSecret;
	}

	/**
	 * @param mixed $consumerSecret
	 */
	public function setConsumerSecret($consumerSecret) {
		$this->consumerSecret = $consumerSecret;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getAttributesMap() {
		return [
			'resellerToken' => $this->getResellerToken(),
			'consumerKey' => $this->getConsumerKey(),
			'consumerSecret' => $this->getConsumerSecret()
		];
	}

	/**
	 * @return string
	 */
	public function toString() {
		return sprintf(
			"ApplicationCredentials[ resellerToken : %s , consumerKey: %s , consumerSecret: %s]", $this->getResellerToken(), $this->getConsumerKey(), $this->getConsumerSecret()
		);
	}

}
