<?php

/**
 * Lists all the available payment methods for direct payment
 *
 * @package Yapay\Enum\DirectPayment
 */
class Eloom_Yapay_Enum_DirectPayment_Method {

	const BOLETO = '6';
	const AVAILABLE_PAYMENT_METHODS = '3,4,5,6,15,16,18,19,20,25';
	const ONLINE_DEBIT = 'eft';

	public static $paymentMethod = array(
		'visa' => '3',
		'mastercard' => '4',
		'amex' => '5',
		'discover' => '15',
		'elo' => '16',
		'aura' => '18',
		'jcb' => '19',
		'hipercard' => '20',
		'hiper' => '25',
	);

	public static function getPaymentMethodId($code) {
		if (array_key_exists($code, self::$paymentMethod)) {
			$v = self::$paymentMethod[$code];
			return $v;
		}

		return null;
	}
}
