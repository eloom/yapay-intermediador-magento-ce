<?php

class Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Transaction {

	use Eloom_Yapay_Domains_Requests_Transaction_Transaction;

	private $transaction;

	public function __construct($transaction) {
		$this->transaction = $transaction;
	}
}