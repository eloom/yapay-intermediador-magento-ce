<?php

/**
 * Class Payment
 * @package Yapay\Parsers\Checkout
 */
class Eloom_Yapay_Parsers_Transaction_Notification_Request extends Eloom_Yapay_Parsers_Error implements Eloom_Yapay_Parsers_Parser {

	/**
	 * @param \Yapay\Resources\Http $http
	 * @return Response
	 */
	public static function success(Eloom_Yapay_Resources_Http $http) {
		$json = json_decode($http->getResponse());
		$transaction = $json->data_response->transaction;

		return (new Eloom_Yapay_Parsers_Transaction_Response)
			->setPayment($transaction->payment)
			->setCustomer($transaction->customer)
			->setOrderNumber($transaction->order_number)
			->setFree($transaction->free)
			->setTransactionId($transaction->transaction_id)
			->setStatusName($transaction->status_name)
			->setStatusId($transaction->status_id)
			->setTokenTransaction($transaction->token_transaction);
	}

	/**
	 * @param \Yapay\Resources\Http $http
	 * @return \Yapay\Domains\Error
	 */
	public static function error(Eloom_Yapay_Resources_Http $http) {
		$error = parent::error($http);
		return $error;
	}

}
