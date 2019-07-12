<?php

/**
 * Class Permission
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_Permission {

	/**
	 * @var
	 */
	private $code;

	/**
	 * @var
	 */
	private $status;

	/**
	 * @var
	 */
	private $lastUpdate;

	/**
	 * @return mixed
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @param mixed $code
	 * @return Permission
	 */
	public function setCode($code) {
		$this->code = $code;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLastUpdate() {
		return $this->lastUpdate;
	}

	/**
	 * @param mixed $lastUpdate
	 * @return Permission
	 */
	public function setLastUpdate($lastUpdate) {
		$this->lastUpdate = $lastUpdate;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param mixed $status
	 * @return Permission
	 */
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}

}
