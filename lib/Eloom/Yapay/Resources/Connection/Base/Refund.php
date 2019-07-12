<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_Refund {

	/**
	 * @return string
	 */
	public function buildRefundRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Refund::getRequestUrl();
	}

}
