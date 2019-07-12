<?php

/**
 * Class Payment
 * @package Yapay\Services\Checkout
 */
class Eloom_Yapay_Services_Transactions_Search_Code {

	/**
	 * @param \Yapay\Domains\Account\Credentials $credentials
	 * @param $code
	 * @return string
	 * @throws \Exception
	 */
	public static function search(Eloom_Yapay_Domains_Account_Credentials $credentials, $code) {
		try {
			$connection = new Eloom_Yapay_Resources_Connection_Data($credentials);
			$http = new Eloom_Yapay_Resources_Http();
			$http->get(self::request($connection, $code));
			$response = Eloom_Yapay_Resources_Responsibility::http($http, new Eloom_Yapay_Parsers_Transaction_Search_Code_Request());
			return $response;
		} catch (\Exception $exception) {
			throw $exception;
		}
	}

	/**
	 * @param Connection\Data $connection
	 * @return string
	 */
	private static function request(Eloom_Yapay_Resources_Connection_Data $connection, $code) {
		return sprintf("%s/%s/?%s", $connection->buildTransactionSearchRequestUrl(), $code, $connection->buildCredentialsQuery());
	}

}
