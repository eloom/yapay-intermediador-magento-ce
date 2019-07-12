<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_Application_Authorization {

	/**
	 * @return string
	 */
	public function buildAuthorizationRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Application_Authorization::getRequestUrl();
	}

	/**
	 * @return string
	 */
	public function buildAuthorizationResponseUrl() {
		return Eloom_Yapay_Resources_Builder_Application_Authorization::getResponseUrl();
	}

}
