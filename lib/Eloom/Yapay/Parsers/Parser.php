<?php

/**
 * Interface Parser
 * @package Yapay\Parsers
 */
interface Eloom_Yapay_Parsers_Parser {

	/**
	 * @param Http $http
	 * @return mixed
	 */
	public static function success(Eloom_Yapay_Resources_Http $http);

	/**
	 * @param Http $http
	 * @return mixed
	 */
	public static function error(Eloom_Yapay_Resources_Http $http);
}
