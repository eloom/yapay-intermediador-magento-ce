<?php

/**
 * Class Notification
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_Notification {

	/**
	 * @var
	 */
	private $code;

	/**
	 * @var
	 */
	private $type;

	/**
	 * @return mixed
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @param $code
	 * @return $this
	 */
	public function setCode($code) {
		$this->code = $code;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param $type
	 * @return $this
	 */
	public function setType($type) {
		$this->type = $type;
		return $this;
	}

}
