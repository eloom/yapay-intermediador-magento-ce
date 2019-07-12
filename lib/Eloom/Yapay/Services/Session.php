<?php

/**
 * The Session Service class
 */
class Eloom_Yapay_Services_Session {

	public static function create(Eloom_Yapay_Domains_Account_Credentials $credentials) {
		try {
			$connection = new Eloom_Yapay_Resources_Connection_Data ($credentials);
			$http = new Eloom_Yapay_Resources_Http();
			$http->post(self::request($connection));

			$response = Eloom_Yapay_Resources_Responsibility::http($http, new Eloom_Yapay_Parsers_Session_Request ());
			return $response;
		} catch (\Exception $exception) {
			throw $exception;
		}
	}

	private static function request(Eloom_Yapay_Resources_Connection_Data $connection) {
		return $connection->buildSessionRequestUrl() . "?" . $connection->buildCredentialsQuery();
	}
}
