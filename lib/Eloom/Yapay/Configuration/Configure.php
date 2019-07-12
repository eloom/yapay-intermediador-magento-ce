<?php

/**
 * Class Configure
 *
 * @package Yapay\Configuration
 */
class Eloom_Yapay_Configuration_Configure {

	private static $accountCredentials;
	private static $applicationCredentials;
	private static $charset;
	private static $environment;

	/**
	 *
	 * @return AccountCredentials
	 */
	public static function getAccountCredentials() {
		if (!isset(self::$accountCredentials)) {
			self::setAccountCredentials(Mage::helper('eloom_yapay/config')->getToken());
		}

		return self::$accountCredentials;
	}

	/**
	 *
	 * @param string $token
	 */
	public static function setAccountCredentials($token) {
		self::$accountCredentials = new Eloom_Yapay_Domains_AccountCredentials ();
		self::$accountCredentials->setToken($token);
	}

	/**
	 *
	 * @return Eloom_Yapay_Domains_ApplicationCredentials
	 */
	public static function getApplicationCredentials() {
		if (!isset(self::$applicationCredentials)) {
			$configuration = Eloom_Yapay_Resources_Responsibility::configuration();
			self::setApplicationCredentials($configuration ['credentials'] ['appId'] ['environment'] [$configuration ['environment']], $configuration ['credentials'] ['appKey'] ['environment'] [$configuration ['environment']]);
		}

		return self::$applicationCredentials;
	}

	/**
	 *
	 * @param string $appId
	 * @param string $appKey
	 */
	public static function setApplicationCredentials($appId, $appKey) {
		self::$applicationCredentials = new Eloom_Yapay_Domains_ApplicationCredentials ();
		self::$applicationCredentials->setAppId($appId)->setAppKey($appKey);
	}

	/**
	 *
	 * @return Environment
	 */
	public static function getEnvironment() {
		if (!isset(self::$environment)) {
			$environment = Mage::helper('eloom_yapay/config')->getEnvironment();
			self::setEnvironment($environment);
		}
		return self::$environment;
	}

	/**
	 *
	 * @param string $environment
	 */
	public static function setEnvironment($environment) {
		self::$environment = new Eloom_Yapay_Domains_Environment ();
		self::$environment->setEnvironment($environment);
	}

	/**
	 *
	 * @return Charset
	 */
	public static function getCharset() {
		if (!isset(self::$charset)) {
			$configuration = Eloom_Yapay_Resources_Responsibility::configuration();
			self::setCharset($configuration ['charset']);
		}
		return self::$charset;
	}

	/**
	 *
	 * @param string $charset
	 */
	public static function setCharset($charset) {
		self::$charset = new Eloom_Yapay_Domains_Charset ();
		self::$charset->setEncoding($charset);
	}

}
