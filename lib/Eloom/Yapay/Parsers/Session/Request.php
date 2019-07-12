<?php

/**
 * Request class
 */
class Eloom_Yapay_Parsers_Session_Request extends Eloom_Yapay_Parsers_Error implements Eloom_Yapay_Parsers_Parser {
	/**
	 * @param \Yapay\Resources\Http $http
	 * @return Response
	 */
	public static function success(Eloom_Yapay_Resources_Http $http) {
		$xml = simplexml_load_string($http->getResponse());
		$result = new Eloom_Yapay_Parsers_Session_Response();
		$result->setResult(current($xml));
		return $result;
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
