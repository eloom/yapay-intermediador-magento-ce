<?php

class Eloom_Yapay_Domains_DirectPayment_CreditCard_Installment {

	private $quantity;
	private $value;

	public function getQuantity() {
		return $this->quantity;
	}

	public function getValue() {
		return $this->value;
	}

	public function setQuantity($quantity) {
		$this->quantity = $quantity;
		return $this;
	}

	public function setValue($value) {
		$this->value = $value;
		return $this;
	}

}
