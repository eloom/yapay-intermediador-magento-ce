<?php

/**
 * Class Installment
 * @package Yapay\Parsers\DirectPayment
 */
trait Eloom_Yapay_Parsers_DirectPayment_Transaction {

	/**
	 * @param Requests $request
	 * @param $properties
	 * @return array
	 */
	public static function getData(Eloom_Yapay_Domains_Requests_Requests $request, $properties) {
		$data = [];
		$transaction = $request->getTransaction();

		$data[$properties::AVAILABLE_PAYMENT_METHOD] = Eloom_Yapay_Enum_DirectPayment_Method::AVAILABLE_PAYMENT_METHODS;
		$data[$properties::NOTIFICATION_URL] = $transaction->getUrlNotification();
		$data[$properties::CUSTOMER_IP] = $transaction->getCustomerIp();
		if (!is_null($transaction->getPriceDiscount())) {
			$data[$properties::PRICE_DISCOUNT] = $transaction->getPriceDiscount();
		}

		$data[$properties::SHIPPING_PRICE] = Eloom_Yapay_Helpers_Currency::toDecimal(
			$transaction->getShippingPrice()
		);
		$data[$properties::SHIPPING_TYPE] = $transaction->getShippingType();

		return array('transaction' => $data);
	}

}
