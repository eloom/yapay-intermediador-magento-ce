<?php

trait Eloom_Yapay_Domains_Requests_PaymentMethod_Accepted {

	private $accept;
	private $exclude;

	/**
	 * @return \Yapay\Resources\Factory\Request\Accepted
	 */
	public function accept() {
		if (is_null($this->accept)) {
			$this->accept = new Eloom_Yapay_Resources_Factory_Request_Accepted();
		}
		return $this->accept;
	}

	/**
	 * @return \Yapay\Resources\Factory\Request\Accepted
	 */
	public function exclude() {
		if (is_null($this->exclude)) {
			$this->exclude = new Eloom_Yapay_Resources_Factory_Request_Accepted();
		}
		return $this->exclude;
	}

	public function getAttributeMap() {
		return [
			'accept' => $this->accept,
			'exclude' => $this->exclude,
		];
	}

}
