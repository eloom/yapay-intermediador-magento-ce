<?php

class Eloom_Yapay_Domains_Environment {

	const PRODUCTION = 'production';
	const SANDBOX = 'sandbox';

	/**
	 *
	 * @var
	 *
	 */
	private $environment;

	/**
	 *
	 * @return string
	 */
	public function getEnvironment() {
		return $this->environment;
	}

	/**
	 *
	 * @param string $environment
	 */
	public function setEnvironment($environment) {
		$this->environment = $environment;
	}

	public function isSandbox() {
		return ($this->environment == self::SANDBOX);
	}

	public function isProduction() {
		return ($this->environment == self::PRODUCTION);
	}

}
