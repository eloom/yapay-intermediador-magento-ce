<?php

/**
 * Class Customer
 * @package Eloom_Yapay_Domains
 */
class Eloom_Yapay_Domains_Customer {

	/**
	 * @var
	 */
	public $name;

	/**
	 * @var
	 */
	public $email;

	/**
	 * @var
	 */
	public $phone;

	/**
	 *
	 * @var
	 *
	 */
	public $birthDate;

	/**
	 * @var
	 */
	public $documents;

	public $companyName;

	public $tradeName;

	public $cnpj;

	/**
	 * Customer constructor.
	 */
	public function __construct() {
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return Customer
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 * @return Customer
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @param Phone $phone
	 * @return Customer
	 */
	public function setPhone(Eloom_Yapay_Domains_Phone $phone) {
		$this->phone = $phone;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDocuments() {
		return $this->documents;
	}

	/**
	 * @param Document $document
	 * @return $this
	 */
	public function setDocuments(Eloom_Yapay_Domains_Document $document) {
		$this->documents[] = $document;
		return $this;
	}

	/*   * *
	 * Add a document for Customer object
	 * @param String $type
	 * @param String $value
	 */

	public function addDocument($type, $value) {
		if ($type && $value) {
			if (count($this->documents) == 0) {
				$document = new Eloom_Yapay_Domains_Document($type, $value);
				$this->documents[] = $document;
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function getBirthDate() {
		return $this->birthDate;
	}

	/**
	 * @param mixed $birthDate
	 */
	public function setBirthDate($birthDate) {
		$this->birthDate = $birthDate;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCompanyName() {
		return $this->companyName;
	}

	/**
	 * @param mixed $companyName
	 */
	public function setCompanyName($companyName) {
		$this->companyName = $companyName;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTradeName() {
		return $this->tradeName;
	}

	/**
	 * @param mixed $tradeName
	 */
	public function setTradeName($tradeName) {
		$this->tradeName = $tradeName;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCnpj() {
		return $this->cnpj;
	}

	/**
	 * @param mixed $cnpj
	 */
	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
		return $this;
	}
}
