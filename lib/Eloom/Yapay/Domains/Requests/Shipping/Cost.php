<?php

trait Eloom_Yapay_Domains_Requests_Shipping_Cost {

	private $cost;

	public function getCost() {
		return current($this->cost);
	}

	public function setCost() {
		$this->cost = new Eloom_Yapay_Resources_Factory_Shipping_Cost($this->shipping);
		return $this->cost;
	}

}
