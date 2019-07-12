<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_DirectPayment_Payment {

	/**
	 * @return string
	 */
	public function buildDirectPaymentRequestUrl() {
		return Eloom_Yapay_Resources_Builder_DirectPayment_Payment::getRequestUrl();
	}

}
