<?php

/**
 * Class Payment
 * @package Yapay\Services\Checkout
 */
class Eloom_Yapay_Services_Checkout_Payment {

	/**
	 * @param \Yapay\Domains\Account\Credentials $credentials
	 * @param \Yapay\Domains\Requests\Payment $payment
	 * @param bool $onlyCode
	 * @return string
	 * @throws \Exception
	 */
	public static function checkout(Eloom_Yapay_Domains_Account_Credentials $credentials, Eloom_Yapay_Domains_Requests_Payment $payment, $onlyCode) {
		try {
			$connection = new Connection\Data($credentials);
			$http = new Eloom_Yapay_Resources_Http();
			$http->post(self::request($connection), Eloom_Yapay_Parsers_Checkout_Request::getData($payment), 20, Eloom_Yapay_Configuration_Configure::getCharset()->getEncoding());

			$response = Eloom_Yapay_Resources_Responsibility::http($http, new Eloom_Yapay_Parsers_Checkout_Request());

			if ($onlyCode) {
				return $response;
			}
			return self::response($connection, $response);
		} catch (Exception $exception) {
			throw $exception;
		}
	}

	/**
	 * @param Connection\Data $connection
	 * @return string
	 */
	private static function request(Eloom_Yapay_Resources_Connection_Data $connection) {
		return $connection->buildPaymentRequestUrl() . "?" . $connection->buildCredentialsQuery();
	}

	/**
	 * @param Connection\Data $connection
	 * @param $response
	 * @return string
	 */
	private static function response(Eloom_Yapay_Resources_Connection_Data $connection, $response) {
		return $connection->buildPaymentResponseUrl() . "?code=" . $response->getCode();
	}

}
