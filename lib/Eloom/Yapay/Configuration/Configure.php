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
	 * @return Eloom_Yapay_Domains_AccountCredentials
	 */
	public static function getAccountCredentials() {
		if (!isset(self::$accountCredentials)) {
			Eloom_Yapay_Library::initialize();
			$configuration = Eloom_Yapay_Resources_Responsibility::configuration();

			self::setAccountCredentials($configuration ['credentials'] ['accountToken'] ['environment'][$configuration ['environment']]);
		}

		return self::$accountCredentials;
	}

	/**
	 *
	 * @param string $token
	 */
	public static function setAccountCredentials($token) {
		self::$accountCredentials = new Eloom_Yapay_Domains_AccountCredentials();
		self::$accountCredentials->setToken($token);
	}

	/**
	 *
	 * @return Eloom_Yapay_Domains_ApplicationCredentials
	 */
	public static function getApplicationCredentials() {
		if (!isset(self::$applicationCredentials)) {
			Eloom_Yapay_Library::initialize();
			$configuration = Eloom_Yapay_Resources_Responsibility::configuration();

			self::setApplicationCredentials($configuration ['credentials'] ['resellerToken'] ['environment'] [$configuration ['environment']],
				$configuration ['credentials'] ['consumerKey'] ['environment'][$configuration ['environment']],
				$configuration ['credentials'] ['consumerSecret'] ['environment'] [$configuration ['environment']]);
		}

		return self::$applicationCredentials;
	}

	/**
	 * @param $resellerToken
	 * @param $consumerKey
	 * @param $consumerSecret
	 */
	public static function setApplicationCredentials($resellerToken, $consumerKey, $consumerSecret) {
		self::$applicationCredentials = new Eloom_Yapay_Domains_ApplicationCredentials ();
		self::$applicationCredentials->setResellerToken($resellerToken)->setConsumerKey($consumerKey)->setConsumerSecret($consumerSecret);
	}

	/**
	 *
	 * @return Environment
	 */
	public static function getEnvironment() {
		if (!isset(self::$environment)) {
			Eloom_Yapay_Library::initialize();
			$configuration = Eloom_Yapay_Resources_Responsibility::configuration();
			self::setEnvironment($configuration ['$environment']);
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
			Eloom_Yapay_Library::initialize();
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
