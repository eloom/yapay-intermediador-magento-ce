<?php

/**
 * Class Basic
 * @package Yapay\Parsers
 */
trait Eloom_Yapay_Parsers_Basic {

	/**
	 * @param Requests $request
	 * @param $properties
	 * @return array
	 */
	public static function getData(Eloom_Yapay_Domains_Requests_Requests $request, $properties) {
		return array($properties::TOKEN => $request->getToken(), $properties::FINGER_PRINT => $request->getFingerPrint());
	}

}
