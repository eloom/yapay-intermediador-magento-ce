<?php

##eloom.licenca##

class Eloom_Yapay_UnprocessableEntityException extends \Exception {

	private $errors = [];

	public function __construct($message, $code = 0, $errors, Exception $previous = null) {
		$this->errors = $errors;
		parent::__construct($message, $code, $previous);
	}

	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}

	public function getErrors() {
		return $this->errors;
	}
}