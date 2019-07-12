<?php

/**
 * Class Basic
 * @package Yapay\Parsers
 */
trait Eloom_Yapay_Parsers_Currency {

	/**
	 * @param Requests $request
	 * @param $properties
	 * @return array
	 */
	public static function getData(Eloom_Yapay_Domains_Requests_Requests $request, $properties) {
		$data = [];
		// currency
		if (!is_null($request->getCurrency())) {
			$data[$properties::CURRENCY] = $request->getCurrency();
		}

		if (!is_null($request->getExtraAmount())) {
			$data[$properties::CURRENCY_EXTRA_AMOUNT] = Eloom_Yapay_Helpers_Currency::toDecimal($request->getExtraAmount());
		}

		return $data;
	}

}
