<?php

/**
 * Class Address
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_Address {

	/**
	 * @var
	 */
	private $type;

	/**
	 * @var
	 */
	private $street;

	/**
	 * @var
	 */
	private $number;

	/**
	 * @var
	 */
	private $complement;

	/**
	 * @var
	 */
	private $district;

	/**
	 * @var
	 */
	private $postalCode;

	/**
	 * @var
	 */
	private $city;

	/**
	 * @var
	 */
	private $state;

	/**
	 * @var
	 */
	private $country;

	/**
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param $city
	 * @return $this
	 */
	public function setCity($city) {
		$this->city = $city;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getComplement() {
		return $this->complement;
	}

	/**
	 * @param $complement
	 * @return $this
	 */
	public function setComplement($complement) {
		$this->complement = $complement;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param $country
	 * @return $this
	 */
	public function setCountry($country) {
		$this->country = $country;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDistrict() {
		return $this->district;
	}

	/**
	 * @param $district
	 * @return $this
	 */
	public function setDistrict($district) {
		$this->district = $district;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * @param $number
	 * @return $this
	 */
	public function setNumber($number) {
		$this->number = $number;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPostalCode() {
		return $this->postalCode;
	}

	/**
	 * @param $postalCode
	 * @return $this
	 */
	public function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @param $state
	 * @return $this
	 */
	public function setState($state) {
		$this->state = $state;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * @param $street
	 * @return $this
	 */
	public function setStreet($street) {
		$this->street = $street;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
}
