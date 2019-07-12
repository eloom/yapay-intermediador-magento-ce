<?php

/**
 * Class Document
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_Document {

	/**
	 * @var
	 */
	private $type;

	/**
	 * @var
	 */
	private $identifier;

	/**
	 * @return string
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * @param string $identifier
	 * @return Document
	 */
	public function setIdentifier($identifier) {
		$this->identifier = $identifier;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param mixed $type
	 * @return Document
	 */
	public function setType($type) {
		$this->type = strtoupper($type);
		return $this;
	}

	/**
	 * @return string
	 */
	public function toString() {
		return sprintf(
			"Document[ Type : %s , Identifier: %s ]", $this->getType(), $this->getIdentifier()
		);
	}

}
