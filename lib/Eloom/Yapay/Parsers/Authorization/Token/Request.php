<?php

/**
 * Class Payment
 * @package Yapay\Parsers\Authorizations\Token
 */
class Eloom_Yapay_Parsers_Authorization_Token_Request extends Eloom_Yapay_Parsers_Error implements Eloom_Yapay_Parsers_Parser {

	/**
	 *
	 * @param $code
	 * @param Eloom_Yapay_Domains_ApplicationCredentials $appCredentials
	 * @return array
	 */
	public static function getData($code, Eloom_Yapay_Domains_ApplicationCredentials $appCredentials) {
		return array('code' => $code, 'consumer_key' => $appCredentials->getConsumerKey(), 'consumer_secret' => $appCredentials->getConsumerSecret());
	}

	/**
	 * @param Eloom_Yapay_Resources_Http $http
	 * @return Eloom_Yapay_Parsers_Authorization_Token_Response
	 */
	public static function success(Eloom_Yapay_Resources_Http $http) {
		$xml = simplexml_load_string($http->getResponse());
		$authorization = $xml->data_response->authorization;
		return (new Eloom_Yapay_Parsers_Authorization_Token_Response)->setAccessToken($authorization->access_token->__toString());
	}

	/**
	 * @param \Yapay\Resources\Http $http
	 * @return \Yapay\Domains\Error
	 */
	public static function error(Eloom_Yapay_Resources_Http $http) {
		return parent::error($http);
	}

}
