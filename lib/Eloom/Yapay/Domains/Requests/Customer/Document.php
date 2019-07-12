<?php

trait Eloom_Yapay_Domains_Requests_Customer_Document {

	private $document;

	public function getDocument() {
		return current($this->document);
	}

	public function setDocument() {
		$this->document = new Eloom_Yapay_Resources_Factory_Customer_Document($this->customer);
		return $this->document;
	}

}
