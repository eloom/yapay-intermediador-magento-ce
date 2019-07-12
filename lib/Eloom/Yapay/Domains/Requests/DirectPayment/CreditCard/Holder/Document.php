<?php

trait Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard_Holder_Document {

	private $document;

	public function getDocument() {
		return current($this->document);
	}

	public function setDocument() {
		$this->document = new Eloom_Yapay_Resources_Factory_Request_DirectPayment_CreditCard_Holder_Document($this->holder);
		return $this->document;
	}

}
