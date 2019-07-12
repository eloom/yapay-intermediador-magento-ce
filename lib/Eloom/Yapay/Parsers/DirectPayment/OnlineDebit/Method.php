<?php

namespace Yapay\Parsers\DirectPayment\OnlineDebit;

/**
 * Class Moede
 * @package Yapay\Parsers\DirectPayment\OnlineDebit
 */
trait Method {
	/**
	 * @param $properties
	 * @return array
	 */
	public static function getData($properties) {
		$data[$properties::AVAILABLE_PAYMENT_METHOD] = \Yapay\Enum\DirectPayment\Method::ONLINE_DEBIT;
		return $data;
	}
}
