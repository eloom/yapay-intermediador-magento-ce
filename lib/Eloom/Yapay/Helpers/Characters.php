<?php

class Eloom_Yapay_Helpers_Characters {

	/**
	 *
	 */
	const PATTERN = "/[^a-z0-9]/";

	/**
	 * @param $subject
	 * @return bool|string
	 */
	public static function hasSpecialChars($subject) {
		if (preg_match(self::PATTERN, $subject)) {
			return self::removeSpecialChars($subject);
		}
		return $subject;
	}

	/**
	 * @param $subject
	 * @return string
	 */
	public static function removeSpecialChars($subject) {
		return preg_replace(self::PATTERN, null, $subject);
	}

}
