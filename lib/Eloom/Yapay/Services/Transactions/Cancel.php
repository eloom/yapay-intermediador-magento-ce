<?php


/**
 * Class Notifications
 * @package Yapay\Services\Transactions
 */
class Eloom_Yapay_Services_Transactions_Cancel {

	/**
	 * @param Eloom_Yapay_Domains_AccountCredentials $credentials
	 * @param $tokenTransaction
	 * @return mixed
	 * @throws Exception
	 */
	public static function cancel(Eloom_Yapay_Domains_AccountCredentials $credentials, $transactionId) {
		try {
			$connection = new Eloom_Yapay_Resources_Connection_Data($credentials);
			$http = new Eloom_Yapay_Resources_Rest();
			$http->get(self::request($connection, $credentials->getToken(), $transactionId));
			$response = Eloom_Yapay_Resources_Responsibility::http($http, new Eloom_Yapay_Parsers_Transaction_Cancel_Request());

			return $response;
		} catch (\Exception $exception) {
			throw $exception;
		}
	}


	/**
	 * @param $connection
	 * @param $token
	 * @param $tokenTransaction
	 * @return string
	 */
	private static function request($connection, $token, $transactionId) {
		return $connection->buildCancelRequestUrl() . "?access_token={$token}&transaction_id={$transactionId}&reason_cancellation_id=6";
	}

}
