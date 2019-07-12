<?php

trait Eloom_Yapay_Domains_Requests_DirectPayment_Billing {

	private $billing;

	/**
	 *
	 * @return \Yapay\Domains\Requests\Adapter\DirectPayment\Billing
	 */
	public function setBilling() {
		$this->billing = Eloom_Yapay_Helpers_InitializeObject::initialize(
			$this->billing, 'Eloom_Yapay_Domains_DirectPayment_Billing'
		);
		return new Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Billing($this->billing);
	}

	/**
	 *
	 * @return billing
	 */
	public function getBilling() {
		return $this->billing;
	}

}
