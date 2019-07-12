<?php

trait Eloom_Yapay_Domains_Requests_DirectPayment_Transaction {

	private $transaction;

	public function setTransaction() {
		$this->transaction = Eloom_Yapay_Helpers_InitializeObject::initialize($this->transaction, 'Eloom_Yapay_Domains_Transaction');
		return new Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Transaction($this->transaction);
	}

	public function getTransaction() {
		return $this->transaction;
	}

}
