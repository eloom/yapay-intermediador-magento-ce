<?php

/**
 * Class Mask
 * @package Yapay\Helpers
 */
class Eloom_Yapay_Helpers_Mask {

	/**
	 * @param $subject
	 * @param array $options
	 * @return bool|string
	 */
	public static function cpf($subject, array $options) {
		if (self::isValidType($options['type'])) {
			return self::toHash(Eloom_Yapay_Helpers_Characters::hasSpecialChars($subject), 3, "********", "###.###.###-##");
		}
	}

	/**
	 * @param $subject
	 * @param array $options
	 * @return bool|string
	 */
	public static function rg($subject, array $options) {
		if (self::isValidType($options['type'])) {
			return self::toHash(Eloom_Yapay_Helpers_Characters::hasSpecialChars($subject), 5, "*****", "##.###.###-##");
		}
	}

	/**
	 * @param $subject
	 * @param array $options
	 * @return bool|string
	 */
	public static function birthDate($subject, array $options) {
		if (self::isValidType($options['type'])) {
			return self::toHash(Eloom_Yapay_Helpers_Characters::hasSpecialChars($subject), 4, "****", "##/##/####");
		}
	}

	public static function phone($subject, array $options) {
		if (Eloom_Yapay_Helpers_Characters::hasSpecialChars($subject)) {
			$subject = Eloom_Yapay_Helpers_Characters::hasSpecialChars($subject);
		}
		$options["prefix"] = true;
		if (strlen($subject) == 8) {
			return self::telephone($subject, $options);
		}
		return self::mobile($subject, $options);
	}

	/**
	 * @param $subject
	 * @param array $options
	 * @return bool|string
	 */
	public static function mobile($subject, array $options) {
		if (self::isValidType($options['type'])) {
			return self::toHash(
				$subject,
				5,
				"****",
				"(##) #####-####",
				["prefix" => true, "length" => 11]
			);
		}
	}

	/**
	 * @param $subject
	 * @param array $options
	 * @return bool|string
	 */
	private static function telephone($subject, array $options) {
		if (self::isValidType($options['type'])) {
			return self::toHash(
				$subject,
				4,
				"****",
				"(##) ####-####",
				["prefix" => true, "length" => 10]
			);
		}
	}

	/**
	 * @param $type
	 * @return bool
	 */
	private static function isValidType($type) {
		if (Eloom_Yapay_Enum_Mask::isValidName(
			Eloom_Yapay_Enum_Mask::getType($type)
		)) {
			return true;
		}
		return false;
	}

	/**
	 * @param $subject
	 * @param $rule
	 * @param $pattern
	 * @param $mask
	 * @param array $options
	 * @return bool|string
	 */
	private static function toHash($subject, $rule, $pattern, $mask, $options = ["prefix" => false]) {
		if ($subject) {
			$subject = substr_replace($subject, $pattern, $rule);
			if ($options['prefix']) {
				return self::mask(str_pad($subject, $options["length"], "*", STR_PAD_LEFT), $mask);
			}
			return self::mask($subject, $mask);
		}
		return false;
	}

	/**
	 * @param $value
	 * @param $mask
	 * @return string
	 */
	private static function mask($value, $mask) {
		$maskared = '';
		$key = 0;
		for ($count = 0; $count <= strlen($mask) - 1; $count++) {
			if ($mask[$count] == '#') {
				if (isset($value[$key])) {
					$maskared .= $value[$key++];
				}
			} else {
				if (isset($mask[$count])) {
					$maskared .= $mask[$count];
				}
			}
		}
		return $maskared;
	}
}
