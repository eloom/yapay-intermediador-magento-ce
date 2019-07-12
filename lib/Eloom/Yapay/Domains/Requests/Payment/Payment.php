<?php

trait Eloom_Yapay_Domains_Requests_Payment_Payment {

	/**
	 * @return mixed
	 */
	public function getPaymentMethodId() {
		return $this->payment->gaymentMethodId;
	}

	/**
	 * @param mixed $paymentMethodId
	 */
	public function setPaymentMethodId($paymentMethodId) {
		$this->payment->setPaymentMethodId($paymentMethodId);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCardName() {
		return $this->payment->cardName;
	}

	/**
	 * @param mixed $cardName
	 */
	public function setCardName($cardName) {
		$this->payment->setCardName($cardName);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCardNumber() {
		return $this->payment->cardNumber;
	}

	/**
	 * @param mixed $cardNumber
	 */
	public function setCardNumber($cardNumber) {
		$this->payment->setCardNumber($cardNumber);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCardExpdateMonth() {
		return $this->payment->cardExpdateMonth;
	}

	/**
	 * @param mixed $cardExpdateMonth
	 */
	public function setCardExpdateMonth($cardExpdateMonth) {
		$this->payment->setCardExpdateMonth($cardExpdateMonth);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCardExpdateYear() {
		return $this->payment->cardExpdateYear;
	}

	/**
	 * @param mixed $cardExpdateYear
	 */
	public function setCardExpdateYear($cardExpdateYear) {
		$this->payment->setCardExpdateYear($cardExpdateYear);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCardCvv() {
		return $this->payment->cardCvv;
	}

	/**
	 * @param mixed $cardCvv
	 */
	public function setCardCvv($cardCvv) {
		$this->payment->setCardCvv($cardCvv);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSplit() {
		return $this->payment->split;
	}

	/**
	 * @param mixed $split
	 */
	public function setSplit($split) {
		$this->payment->setSplit($split);
		return $this;
	}
}