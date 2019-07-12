<?php

/**
 * Class Session
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_Session {

	/**
	 * @return string
	 */
	public function buildSessionRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Session::getRequestUrl();
	}

}
