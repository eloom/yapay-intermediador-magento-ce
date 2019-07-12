<?php

/**
 * Class Credentials
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_Credentials {

	/**
	 *
	 * @var
	 *
	 */
	private $credentials;

	/**
	 *
	 * @return \Yapay\Domains\Account\Credentials
	 */
	public function getCredentials() {
		return $this->credentials;
	}

	/**
	 *
	 * @param \Yapay\Domains\Account\Credentials $credentials
	 * @return Credentials
	 */
	public function setCredentials(Eloom_Yapay_Domains_Account_Credentials $credentials) {
		$this->credentials = $credentials;
		return $this;
	}

	/**
	 *
	 * @return string
	 */
	public function buildCredentialsQuery() {
		return http_build_query($this->credentials->getAttributesMap(), '', '&');
	}

}
