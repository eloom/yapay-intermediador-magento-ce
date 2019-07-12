<?php

/**
 * Class Payment
 * @package Yapay\Parsers\Checkout
 */
class Eloom_Yapay_Parsers_Transaction_Search_Code_Request extends Eloom_Yapay_Parsers_Error implements Eloom_Yapay_Parsers_Parser {

	/**
	 * @param $code
	 * @return array
	 */
	public static function getData($code) {
		$data = [];
		$properties = new Eloom_Yapay_Enum_Properties_Current();

		if (!is_null($code)) {
			$data[$properties::TRANSACTION_CODE] = $code;
		}
		return $data;
	}

	/**
	 * @param \Yapay\Resources\Http $http
	 * @return Response
	 */
	public static function success(Eloom_Yapay_Resources_Http $http) {
		$xml = simplexml_load_string($http->getResponse());
		$response = new Eloom_Yapay_Parsers_Transaction_Response();
		$response->setDate(current($xml->date))
			->setCode(current($xml->code))
			->setReference(current($xml->reference))
			->setType(current($xml->type))
			->setStatus(current($xml->status))
			->setLastEventDate(current($xml->lastEventDate))
			->setPaymentMethod($xml->paymentMethod)
			->setGrossAmount(current($xml->grossAmount))
			->setDiscountAmount(current($xml->discountAmount))
			->setCreditorFees($xml->creditorFees)
			->setNetAmount(current($xml->netAmount))
			->setExtraAmount(current($xml->extraAmount))
			->setEscrowEndDate(current($xml->escrowEndDate))
			->setInstallmentCount(current($xml->installmentCount))
			->setItemCount(current($xml->itemCount))
			->setItems($xml->items)
			->setCustomer($xml->sender)
			->setShipping($xml->shipping);
		return $response;
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
