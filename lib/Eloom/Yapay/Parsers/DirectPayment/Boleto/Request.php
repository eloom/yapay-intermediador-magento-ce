<?php

/**
 * Class Payment
 * @package Yapay\Parsers\DirectPayment\Boleto
 */
class Eloom_Yapay_Parsers_DirectPayment_Boleto_Request extends Eloom_Yapay_Parsers_Error implements Eloom_Yapay_Parsers_Parser {

	use Eloom_Yapay_Parsers_Basic;
	use Eloom_Yapay_Parsers_Currency;
	use Eloom_Yapay_Parsers_DirectPayment_Boleto_Payment;
	use Eloom_Yapay_Parsers_TransactionProduct;
	use Eloom_Yapay_Parsers_Customer;

	/**
	 * @param \Yapay\Domains\Requests\DirectPayment\Boleto $boleto
	 * @return array
	 */
	public static function getData(Eloom_Yapay_Domains_Requests_DirectPayment_Boleto $boleto) {
		$data = [];
		$properties = new Eloom_Yapay_Enum_Properties_BackwardCompatibility();

		$d = array_merge($data,
			Eloom_Yapay_Parsers_Basic::getData($boleto, $properties),
			Eloom_Yapay_Parsers_Customer::getData($boleto, $properties),
			Eloom_Yapay_Parsers_Currency::getData($boleto, $properties),
			Eloom_Yapay_Parsers_DirectPayment_Boleto_Payment::getData($boleto, $properties),
			Eloom_Yapay_Parsers_DirectPayment_Transaction::getData($boleto, $properties),
			Eloom_Yapay_Parsers_TransactionProduct::getData($boleto, $properties));

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
