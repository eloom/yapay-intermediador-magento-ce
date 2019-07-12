<?php


/**
 * Class Customer
 * @package Eloom_Yapay_Domains
 */
class Eloom_Yapay_Domains_Payment {

	private $paymentMethodId;

	private $cardName;

	private $cardNumber;

	private $cardExpdateMonth;

	private $cardExpdateYear;

	private $cardCvv;

	private $split;

	/**
	 * @return mixed
	 */
	public function getPaymentMethodId() {
		return $this->paymentMethodId;
	}

	/**
	 * @param mixed $paymentMethodId
	 */
	public function setPaymentMethodId($paymentMethodId) {
		$this->paymentMethodId = $paymentMethodId;
	}

	/**
	 * @return mixed
	 */
	public function getCardName() {
		return $this->cardName;
	}

	/**
	 * @param mixed $cardName
	 */
	public function setCardName($cardName) {
		$this->cardName = $cardName;
	}

	/**
	 * @return mixed
	 */
	public function getCardNumber() {
		return $this->cardNumber;
	}

	/**
	 * @param mixed $cardNumber
	 */
	public function setCardNumber($cardNumber) {
		$this->cardNumber = $cardNumber;
	}

	/**
	 * @return mixed
	 */
	public function getCardExpdateMonth() {
		return $this->cardExpdateMonth;
	}

	/**
	 * @param mixed $cardExpdateMonth
	 */
	public function setCardExpdateMonth($cardExpdateMonth) {
		$this->cardExpdateMonth = $cardExpdateMonth;
	}

	/**
	 * @return mixed
	 */
	public function getCardExpdateYear() {
		return $this->cardExpdateYear;
	}

	/**
	 * @param mixed $cardExpdateYear
	 */
	public function setCardExpdateYear($cardExpdateYear) {
		$this->cardExpdateYear = $cardExpdateYear;
	}

	/**
	 * @return mixed
	 */
	public function getCardCvv() {
		return $this->cardCvv;
	}

	/**
	 * @param mixed $cardCvv
	 */
	public function setCardCvv($cardCvv) {
		$this->cardCvv = $cardCvv;
	}

	/**
	 * @return mixed
	 */
	public function getSplit() {
		return $this->split;
	}

	/**
	 * @param mixed $split
	 */
	public function setSplit($split) {
		$this->split = $split;
	}
}