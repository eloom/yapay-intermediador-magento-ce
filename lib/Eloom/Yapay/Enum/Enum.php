<?php

/**
 * Class Enum
 * @package Yapay\Enum
 */
class Eloom_Yapay_Enum_Enum extends Eloom_Yapay_Enum_BaseEnum {

	/**
	 * @return array
	 */
	public static function getList() {
		$reflection = new \ReflectionClass(get_called_class());
		return $reflection->getConstants();
	}

	/**
	 * @param $key
	 * @return string
	 */
	public static function getType($key) {
		$declared = self::getList();
		if (array_search($key, $declared)) {
			return array_search($key, $declared);
		} else {
			return false;
		}
	}

	/**
	 * @param $value
	 * @return bool
	 */
	public static function getValue($value) {
		$values = array_values(parent::getConstants());
		return in_array($value, $values, true);
	}

}
