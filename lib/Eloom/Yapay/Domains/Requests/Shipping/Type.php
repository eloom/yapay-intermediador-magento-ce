<?php

trait Eloom_Yapay_Domains_Requests_Shipping_Type {

	private $type;

	public function getType() {
		return current($this->type);
	}

	public function setType() {
		$this->type = new Eloom_Yapay_Resources_Factory_Shipping_Type($this->shipping);
		return $this->type;
	}

}
