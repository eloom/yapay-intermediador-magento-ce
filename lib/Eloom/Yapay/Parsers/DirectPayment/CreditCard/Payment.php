<?php

/**
 * Class Customer
 * @package Yapay\Parsers
 */
trait Eloom_Yapay_Parsers_DirectPayment_CreditCard_Payment {

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
			$data[$properties::CREDIT_CARD_HOLDER_NAME] = $payment->getCardName();
			$data[$properties::CREDIT_CARD_NUMBER] = $payment->getCardNumber();
			$data[$properties::CREDIT_CARD_EXPDATE_MONTH] = $payment->getCardExpdateMonth();
			$data[$properties::CREDIT_CARD_EXPDATE_YEAR] = $payment->getCardExpdateYear();
			$data[$properties::CREDIT_CARD_CVV] = $payment->getCardCvv();
			$data[$properties::SPLIT] = $payment->getSplit();
		}

		return array('payment' => $data);
	}

}
