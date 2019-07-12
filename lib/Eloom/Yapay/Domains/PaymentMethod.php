<?php

/**
 * Class PaymentMethod
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_PaymentMethod {

	/**
	 * @var
	 */
	private $group;

	/**
	 * @var
	 */
	private $key;

	/**
	 * @var
	 */
	private $value;

	/**
	 * @return mixed
	 */
	public function getGroup() {
		return $this->group;
	}

	/**
	 * @param mixed $group
	 * @return PaymentMethod
	 */
	public function setGroup($group) {
		$this->group = $group;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getKey() {
		return $this->key;
	}

	/**
	 * @param mixed $key
	 * @return PaymentMethod
	 */
	public function setKey($key) {
		$this->key = $key;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param mixed $value
	 * @return PaymentMethod
	 */
	public function setValue($value) {
		$this->value = $value;
		return $this;
	}

}
