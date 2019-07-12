<?php

class Eloom_Yapay_Domains_DirectPayment_CreditCard_Holder {

	/**
	 * *
	 * Credit card holder name
	 */
	private $name;

	/**
	 * *
	 * Credit card holder birth date
	 */
	private $birthDate;

	/**
	 * *
	 * Credit card holder cpf
	 */
	private $documents;

	/**
	 * *
	 * Credit card holder phone
	 */
	private $phone;

	/**
	 *
	 * @return mixed
	 */
	public function getBirthDate() {
		return $this->birthDate;
	}

	/**
	 *
	 * @param mixed $birthDate
	 * @return Holder
	 */
	public function setBirthDate($birthDate) {
		$this->birthDate = $birthDate;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getDocuments() {
		return $this->documents;
	}

	/**
	 *
	 * @param mixed $documents
	 * @return Holder
	 */
	public function setDocuments($documents) {
		$this->documents = $documents;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 *
	 * @param mixed $name
	 * @return Holder
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 *
	 * @param mixed $phone
	 * @return Holder
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
		return $this;
	}

}
