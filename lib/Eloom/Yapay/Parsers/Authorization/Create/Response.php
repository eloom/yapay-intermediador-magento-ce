<?php

/**
 * Class Response
 * @package Yapay\Parsers\Transaction
 */
class Eloom_Yapay_Parsers_Authorization_Create_Response {

	private $code;

	/**
	 * @return mixed
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @param mixed $code
	 */
	public function setCode($code) {
		$this->code = $code;
		return $this;
	}
}
