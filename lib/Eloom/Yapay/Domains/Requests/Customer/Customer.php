<?php

trait Eloom_Yapay_Domains_Requests_Customer_Customer {

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->customer->email;
	}

	/**
	 * @param mixed $email
	 * @return Customer
	 */
	public function setEmail($email) {
		$this->customer->setEmail($email);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->customer->name;
	}

	/**
	 * @param mixed $name
	 * @return Customer
	 */
	public function setName($name) {
		$this->customer->setName($name);
		return $this;
	}

	public function setBirthDate($birthDate) {
		$this->customer->setBirthDate($birthDate);
		return $this;
	}

	public function getBirthDate() {
		$this->customer->getBirthDate();
	}
}
