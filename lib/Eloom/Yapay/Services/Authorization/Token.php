<?php

/**
 * Class Payment
 * @package Yapay\Services\Authorizations
 */
class Eloom_Yapay_Services_Authorization_Token {


	/**
	 *
	 *
	 * @param string $code
	 * @param Eloom_Yapay_Domains_ApplicationCredentials $appCredentials
	 * @return Eloom_Yapay_Parsers_Authorization_Token_Response
	 * @throws Exception
	 */
	public static function getAccessToken($code, Eloom_Yapay_Domains_ApplicationCredentials $appCredentials) {
		try {
			$connection = new Eloom_Yapay_Resources_Connection_Data(new Eloom_Yapay_Domains_AccountCredentials());
			$http = new Eloom_Yapay_Resources_Http();
			$http->post(self::request($connection), Eloom_Yapay_Parsers_Authorization_Token_Request::getData($code, $appCredentials));

			$response = Eloom_Yapay_Resources_Responsibility::http($http, new Eloom_Yapay_Parsers_Authorization_Token_Request());
			return $response;
		} catch (\Exception $exception) {
			throw $exception;
		}
	}

	/**
	 * @param Eloom_Yapay_Resources_Connection_Data $connection
	 * @return string
	 */
	private static function request(Eloom_Yapay_Resources_Connection_Data $connection) {
		return $connection->buildAuthorizationsAccessTokenUrl();
	}

}
