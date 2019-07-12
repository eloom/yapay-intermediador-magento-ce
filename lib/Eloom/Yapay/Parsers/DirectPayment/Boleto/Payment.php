<?php

/**
 * Class Customer
 * @package Yapay\Parsers
 */
trait Eloom_Yapay_Parsers_DirectPayment_Boleto_Payment {

	/**
	 * @param Requests $request
	 * @param $properties
	 * @return array
	 */
	public static function getData(Eloom_Yapay_Domains_Requests_Requests $request, $properties) {
		$data = [];
		if (!is_null($request->getPayment())) {
			$payment = $request->getPayment();

			$data[$properties::PAYMENT_METHOD_ID] = $payment->getPaymentMethodId();
			$data[$properties::SPLIT] = 1;
		}

		return array('payment' => $data);
	}

}
