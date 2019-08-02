<?php


/**
 * Class Notifications
 * @package Yapay\Services\Transactions
 */
class Eloom_Yapay_Services_Transactions_Cancel {

	/**
	 * @param Eloom_Yapay_Domains_AccountCredentials $credentials
	 * @param $transactionId
	 * @return mixed
	 * @throws Exception
	 */
	public static function cancel(Eloom_Yapay_Domains_AccountCredentials $credentials, $transactionId) {
		try {
			$connection = new Eloom_Yapay_Resources_Connection_Data($credentials);
			$http = new Eloom_Yapay_Resources_Rest();

			$data = array('access_token' => $credentials->getToken(), 'transaction_id' => $transactionId, 'reason_cancellation_id' => 6);
			$http->patch(self::request($connection), $data);

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
	private static function request($connection) {
		return $connection->buildCancelRequestUrl();
	}

}
