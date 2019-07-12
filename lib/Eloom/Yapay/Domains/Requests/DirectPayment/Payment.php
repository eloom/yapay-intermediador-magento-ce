<?php

trait Eloom_Yapay_Domains_Requests_DirectPayment_Payment {

	private $payment;

	public function setPayment() {
		$this->payment = Eloom_Yapay_Helpers_InitializeObject::initialize($this->payment, 'Eloom_Yapay_Domains_Payment');
		return new Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Payment($this->payment);
	}

	public function getPayment() {
		return $this->payment;
	}

}
