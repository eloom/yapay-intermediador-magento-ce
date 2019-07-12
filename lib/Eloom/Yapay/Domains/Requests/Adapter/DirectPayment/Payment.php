<?php

class Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Payment {

	use Eloom_Yapay_Domains_Requests_Payment_Payment;

	private $payment;

	public function __construct($payment) {
		$this->payment = $payment;
	}
}