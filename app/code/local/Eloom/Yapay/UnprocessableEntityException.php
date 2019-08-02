<?php

##eloom.licenca##

class Eloom_Yapay_UnprocessableEntityException extends \Exception {

	private $errors = [];

	private $additionalData;

	public function __construct($message, $code = 0, $errors, $additionalData, Exception $previous = null) {
		$this->errors = $errors;
		$this->additionalData = $additionalData;
		parent::__construct($message, $code, $previous);
	}

	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}

	public function getErrors() {
		return $this->errors;
	}

	/**
	 * @return mixed
	 */
	public function getAdditionalData() {
		return $this->additionalData;
	}
}