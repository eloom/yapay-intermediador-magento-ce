<?php

/**
 * Class Payment
 * @package Yapay\Services\DirectPayment
 */
class Eloom_Yapay_Services_DirectPayment_Boleto {

	/**
	 * @param \Yapay\Domains\Account\Credentials $credentials
	 * @param \Yapay\Domains\Requests\DirectPayment\Boleto $payment
	 * @return string
	 * @throws \Exception
	 */
	public static function checkout(
		Eloom_Yapay_Domains_Account_Credentials $credentials, Eloom_Yapay_Domains_Requests_DirectPayment_Boleto $payment
	) {
		try {
			$connection = new Eloom_Yapay_Resources_Connection_Data($credentials);
			$http = new Eloom_Yapay_Resources_Http();
			$http->post(self::request($connection), Eloom_Yapay_Parsers_DirectPayment_Boleto_Request::getData($payment));
			$response = Eloom_Yapay_Resources_Responsibility::http($http, new Eloom_Yapay_Parsers_DirectPayment_Boleto_Request());

			return $response;
		} catch (\Exception $exception) {
			throw $exception;
		}
	}

	/**
	 * @param Connection\Data $connection
	 * @return string
	 */
	private static function request(Eloom_Yapay_Resources_Connection_Data $connection) {
		return $connection->buildDirectPaymentRequestUrl() . "?" . $connection->buildCredentialsQuery();
	}

}
