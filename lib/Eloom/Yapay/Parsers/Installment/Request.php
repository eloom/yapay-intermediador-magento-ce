<?php

##eloom.licenca##

/**
 * Class Installment
 */
class Eloom_Yapay_Parsers_Installment_Request extends Eloom_Yapay_Parsers_Error implements Eloom_Yapay_Parsers_Parser {
	/**
	 * @param Http $http
	 * @return \Yapay\Parsers\Installment\Response
	 */
	public static function success(Eloom_Yapay_Resources_Http $http) {
		return simplexml_load_string($http->getResponse());
	}

	/**
	 * @param \Yapay\Resources\Http $http
	 * @return \Yapay\Domains\Error
	 */
	public static function error(Eloom_Yapay_Resources_Http $http) {
		$error = parent::error($http);
		return $error;
	}
}