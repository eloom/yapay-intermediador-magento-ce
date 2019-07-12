<?php

/**
 * Class Error
 * @package Yapay\Parsers
 */
class Eloom_Yapay_Parsers_Error {

	/**
	 *
	 * @param \Yapay\Resources\Http $http
	 * @return \Yapay\Domains\Error
	 */
	protected static function error(Eloom_Yapay_Resources_Http $http) {
		$error = new Eloom_Yapay_Domains_Error ();
		$error->setCode($http->getStatus())->setMessage($http->getResponse());

		return $error;
	}

}
