<?php

/**
 * Class Customer
 * @package Yapay\Domains\Requests
 */
trait Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard_Holder {

	/**
	 * @var
	 */
	private $holder;

	/**
	 * @return \Yapay\Domains\Requests\Adapter\DirectPayment\Holder
	 */
	public function setHolder() {
		$this->holder = Eloom_Yapay_Helpers_InitializeObject::initialize(
			$this->holder, 'Eloom_Yapay_Domains_DirectPayment_CreditCard_Holder'
		);
		return new Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Holder($this->holder);
	}

	/**
	 * @return \Yapay\Domains\DirectPayment\CreditCard\Holder
	 */
	public function getHolder() {
		return $this->holder;
	}

}
