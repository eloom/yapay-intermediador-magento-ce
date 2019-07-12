<?php

/**
 * Class Metadata
 *
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_Metadata {

	/**
	 * Metadata key
	 */
	private $key;

	/**
	 * Metadata value
	 */
	private $value;

	/**
	 * Metadata group
	 */
	private $group;

	public function getKey() {
		return $this->key;
	}

	public function setKey($key) {
		$this->key = $key;
		return $this;
	}

	public function getValue() {
		return $this->value;
	}

	public function setValue($value) {
		$this->value = $value;
		return $this;
	}

	public function getGroup() {
		return $this->group;
	}

	public function setGroup($group) {
		$this->group = $group;
		return $this;
	}

}
