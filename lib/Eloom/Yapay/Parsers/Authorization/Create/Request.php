<?php

/**
 * Class Payment
 * @package Yapay\Parsers\Authorizations\Create
 */
class Eloom_Yapay_Parsers_Authorization_Create_Request extends Eloom_Yapay_Parsers_Error implements Eloom_Yapay_Parsers_Parser {

	/**
	 *
	 *
	 * @param Eloom_Yapay_Domains_AccountCredentials $accountCredentials
	 * @param Eloom_Yapay_Domains_ApplicationCredentials $appCredentials
	 * @return array
	 */
	public static function getData(Eloom_Yapay_Domains_AccountCredentials $accountCredentials, Eloom_Yapay_Domains_ApplicationCredentials $appCredentials) {
		return array('reseller_token' => $appCredentials->getResellerToken(), 'token_account' => $accountCredentials->getToken(), 'consumer_key' => $appCredentials->getConsumerKey(), 'consumer_secret' => $appCredentials->getConsumerSecret(), 'type_response' => 'J');
	}

	/**
	 * @param Eloom_Yapay_Resources_Http $http
	 * @return Eloom_Yapay_Parsers_Authorization_Create_Response
	 */
	public static function success(Eloom_Yapay_Resources_Http $http) {
		$json = json_decode($http->getResponse());
		$authorization = $json->data_response->authorization;

		return (new Eloom_Yapay_Parsers_Authorization_Create_Response)->setCode($authorization->code);
	}

	/**
	 * @param \Yapay\Resources\Http $http
	 * @return \Yapay\Domains\Error
	 */
	public static function error(Eloom_Yapay_Resources_Http $http) {
		return parent::error($http);
	}

}
