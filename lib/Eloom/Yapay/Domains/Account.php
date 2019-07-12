<?php

/**
 * Class Account
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_Account {

	/**
	 * @var
	 */
	private $publicKey;

	/**
	 * @return mixed
	 */
	public function getPublicKey() {
		return $this->publicKey;
	}

	/**
	 * @param mixed $publicKey
	 */
	public function setPublicKey($publicKey) {
		$this->publicKey = $publicKey;
	}

}
