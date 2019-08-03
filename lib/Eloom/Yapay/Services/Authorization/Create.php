<?php

/**
 * Class Payment
 * @package Yapay\Services\Authorizations
 */
class Eloom_Yapay_Services_Authorization_Create {


	/**
	 *
	 *
	 * @param Eloom_Yapay_Domains_AccountCredentials $accountCredentials
	 * @param Eloom_Yapay_Domains_ApplicationCredentials $appCredentials
	 * @return Eloom_Yapay_Parsers_Authorization_Create_Response
	 * @throws Exception
	 */
	public static function create(
		Eloom_Yapay_Domains_AccountCredentials $accountCredentials,
		Eloom_Yapay_Domains_ApplicationCredentials $appCredentials
	) {
		try {
			$connection = new Eloom_Yapay_Resources_Connection_Data($accountCredentials);
			$http = new Eloom_Yapay_Resources_Http();
			$http->post(self::request($connection), Eloom_Yapay_Parsers_Authorization_Create_Request::getData($accountCredentials, $appCredentials));
			$response = Eloom_Yapay_Resources_Responsibility::http($http, new Eloom_Yapay_Parsers_Authorization_Create_Request());

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
		return $connection->buildResselerAuthorizationsUrl();
	}

}
