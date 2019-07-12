<?php

/**
 * Description of Installment
 *
 * @package \Yapay\Domains\Requests\DirectPayment\CreditCard
 */
trait Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard_Installment {

	private $installment;

	public function getInstallment() {
		return $this->installment;
	}

	public function setInstallment() {
		$this->installment = new Eloom_Yapay_Resources_Factory_Request_DirectPayment_CreditCard_Installment();
		return $this->installment;
	}

}
