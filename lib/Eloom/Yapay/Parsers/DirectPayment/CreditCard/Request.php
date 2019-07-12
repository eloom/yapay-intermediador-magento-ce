<?php

/**
 * Class Payment
 * @package Yapay\Parsers\DirectPayment\CreditCard
 */
class Eloom_Yapay_Parsers_DirectPayment_CreditCard_Request extends Eloom_Yapay_Parsers_Error implements Eloom_Yapay_Parsers_Parser {

	use Eloom_Yapay_Parsers_Basic;
	use Eloom_Yapay_Parsers_Currency;
	use Eloom_Yapay_Parsers_DirectPayment_Transaction;
	use Eloom_Yapay_Parsers_DirectPayment_CreditCard_Payment;
	use Eloom_Yapay_Parsers_TransactionProduct;
	use Eloom_Yapay_Parsers_Customer;

	/**
	 * @param \Yapay\Domains\Requests\DirectPayment\CreditCard $creditCard
	 * @return array
	 */
	public static function getData(Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard $creditCard) {
		$data = [];
		$properties = new Eloom_Yapay_Enum_Properties_BackwardCompatibility();

		$d = array_merge($data,
			Eloom_Yapay_Parsers_Basic::getData($creditCard, $properties),
			Eloom_Yapay_Parsers_Customer::getData($creditCard, $properties),
			Eloom_Yapay_Parsers_Currency::getData($creditCard, $properties),
			Eloom_Yapay_Parsers_DirectPayment_CreditCard_Payment::getData($creditCard, $properties),
			Eloom_Yapay_Parsers_DirectPayment_Transaction::getData($creditCard, $properties),
			Eloom_Yapay_Parsers_TransactionProduct::getData($creditCard, $properties));

		return $d;
	}

	/**
	 * @param \Yapay\Resources\Http $http
	 * @return Response
	 */
	public static function success(Eloom_Yapay_Resources_Http $http) {
		$json = json_decode($http->getResponse());
		$transaction = $json->data_response->transaction;

		return (new Eloom_Yapay_Parsers_Transaction_CreditCard_Response)
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
		return parent::error($http);
	}

}
