<?php

namespace Yapay\Parsers\DirectPayment\OnlineDebit;

use Yapay\Domains\Requests\Requests;

/**
 * Description of BankName
 * @package Yapay\Parsers\DirectPayment\OnlineDebit
 */
trait BankName {

	/**
	 * @param Requests $request
	 * @param $properties
	 * @return array
	 */
	public static function getData(Requests $request, $properties) {
		$data = [];

		if (!is_null($request->getBankName())) {
			$data[$properties::ONLINE_DEBIT_BANK_NAME] = $request->getBankName();
		}

		return $data;
	}
}
