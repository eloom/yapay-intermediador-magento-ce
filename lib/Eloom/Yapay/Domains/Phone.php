<?php

/**
 * Class Phone
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_Phone {

	/**
	 * @var
	 */
	private $areaCode;

	/**
	 * @var
	 */
	private $number;

	/**
	 * @return integer
	 */
	public function getAreaCode() {
		return $this->areaCode;
	}

	/**
	 * @param integer $areaCode
	 * @return Phone
	 */
	public function setAreaCode($areaCode) {
		$this->areaCode = $areaCode;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * @param integer $number
	 * @return Phone
	 */
	public function setNumber($number) {
		$this->number = $number;
		return $this;
	}

}
