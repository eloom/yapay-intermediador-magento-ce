<?php


/**
 * Class Notifications
 * @package Yapay\Services\Transactions
 */
class Eloom_Yapay_Services_Transactions_Notification {

	/**
	 * @param Eloom_Yapay_Domains_AccountCredentials $credentials
	 * @param $tokenTransaction
	 * @return mixed
	 * @throws Exception
	 */
	public static function check(Eloom_Yapay_Domains_AccountCredentials $credentials, $tokenTransaction) {
		try {
			$connection = new Eloom_Yapay_Resources_Connection_Data($credentials);
			$http = new Eloom_Yapay_Resources_Http();
			$http->get(self::request($connection, $credentials->getToken(), $tokenTransaction));
			$response = Eloom_Yapay_Resources_Responsibility::http($http, new Eloom_Yapay_Parsers_Transaction_Notification_Request());

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
	private static function request($connection, $token, $tokenTransaction) {
		return $connection->buildNotificationTransactionRequestUrl() . "?token_account=" . $token . "&token_transaction=" . $tokenTransaction;
	}

}
