<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Installment
 *
 * @package Yapay\Resources\Factory\Request\DirectPayment\CreditCard
 */
class Eloom_Yapay_Resources_Factory_Request_DirectPayment_CreditCard_Installment {

	private $installment;

	public function __construct() {
		$this->installment = [];
	}

	public function instance(Eloom_Yapay_Domains_DirectPayment_CreditCard_Installment $installment) {
		return $installment;
	}

	public function withArray($array) {
		$installment = new Eloom_Yapay_Domains_DirectPayment_CreditCard_Installment();
		$installment->setQuantity($array['quantity'])
			->setValue($array['value']);

		$this->installment = $installment;
		return $this->installment;
	}

	public function withParameters($quantity, $value) {
		$installment = new Eloom_Yapay_Domains_DirectPayment_CreditCard_Installment();
		$installment->setQuantity($quantity)
			->setValue($value);
		$this->installment = $installment;

		return $this->installment;
	}

}
