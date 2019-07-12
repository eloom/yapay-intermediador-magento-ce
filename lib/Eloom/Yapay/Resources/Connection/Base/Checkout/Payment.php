<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_Checkout_Payment {

	/**
	 * @return string
	 */
	public function buildPaymentRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Checkout_Payment::getRequestUrl();
	}

	/**
	 * @return string
	 */
	public function buildPaymentResponseUrl() {
		return Eloom_Yapay_Resources_Builder_Checkout_Payment::getResponseUrl();
	}

}
