<?php

use Yapay\Domains\Account\Credentials;
use Yapay\Helpers\Crypto;
use Yapay\Helpers\Mask;
use Yapay\Parsers\DirectPayment\OnlineDebit\Request;
use Yapay\Resources\Connection;
use Yapay\Resources\Http;
use Yapay\Resources\Log\Logger;
use Yapay\Resources\Responsibility;

/**
 * Class Payment
 * @package Yapay\Services\DirectPayment
 */
class Eloom_Yapay_Services_DirectPayment_OnlineDebit {

	/**
	 * @param \Yapay\Domains\Account\Credentials $credentials
	 * @param \Yapay\Domains\Requests\DirectPayment\OnlineDebit $payment
	 * @return string
	 * @throws \Exception
	 */
	public static function checkout(
		Credentials $credentials, \Yapay\Domains\Requests\DirectPayment\OnlineDebit $payment
	) {
		Logger::info("Begin", ['service' => 'DirectPayment.OnlineDebit']);
		try {
			$connection = new Connection\Data($credentials);
			$http = new Http();
			Logger::info(
				sprintf("POST: %s", self::request($connection)), ['service' => 'DirectPayment.OnlineDebit']
			);
			Logger::info(
				sprintf(
					"Params: %s", json_encode(Crypto::encrypt(Request::getData($payment)))
				), ['service' => 'Checkout']
			);
			$http->post(
				self::request($connection), Request::getData($payment)
			);

			$response = Responsibility::http(
				$http, new Request
			);

			Logger::info(
				sprintf("Online Debit Payment Link URL: %s", $response->getPaymentLink()), ['service' => 'DirectPayment.OnlineDebit']
			);

			return $response;
		} catch (\Exception $exception) {
			Logger::error($exception->getMessage(), ['service' => 'DirectPayment.OnlineDebit']);
			throw $exception;
		}
	}

	/**
	 * @param Connection\Data $connection
	 * @return string
	 */
	private static function request(Connection\Data $connection) {
		return $connection->buildDirectPaymentRequestUrl() . "?" . $connection->buildCredentialsQuery();
	}

}
