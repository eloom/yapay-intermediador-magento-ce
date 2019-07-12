<?php

class Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Billing {

	use Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard_Billing_Address;

	private $billing;

	public function __construct($billing) {
		$this->billing = $billing;
	}

}
