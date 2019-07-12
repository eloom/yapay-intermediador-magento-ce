<?php

class Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Holder {

	use Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard_Holder_Document;
	use Eloom_Yapay_Domains_Requests_DirectPayment_CreditCard_Holder_Phone;

	private $holder;

	public function __construct($holder) {
		$this->holder = $holder;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getBirthDate() {
		return $this->holder->getBirthDate();
	}

	/**
	 *
	 * @param mixed $birthdate
	 */
	public function setBirthDate($birthdate) {
		$this->holder->setBirthDate($birthdate);
	}

	/**
	 *
	 * @return mixed
	 */
	public function getName() {
		return $this->holder->getName();
	}

	/**
	 *
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->holder->setName($name);
	}

}
