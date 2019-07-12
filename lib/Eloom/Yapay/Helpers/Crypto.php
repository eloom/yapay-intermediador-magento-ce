<?php


class Eloom_Yapay_Helpers_Crypto {
	private static $list = [
		"senderPhone" => array("phone", Eloom_Yapay_Enum_Mask::PHONE),
		"senderCPF" => array("cpf", Eloom_Yapay_Enum_Mask::CPF)
	];

	public static function encrypt($parameters) {
		foreach (self::$list as $param => $value) {
			if (array_key_exists($param, $parameters)) {
				$parameters[$param] = Eloom_Yapay_Helpers_Mask::{current($value)}($parameters[$param], ["type" => end($value)]);
			}
		}
		return $parameters;
	}
}
