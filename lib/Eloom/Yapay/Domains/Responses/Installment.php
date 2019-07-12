<?php

/**
 * Domain class for Installment
 */
class Eloom_Yapay_Domains_Responses_Installment {

	public $split;

	public $splitValue;

	public $transactionValue;

	public $additionRetention;

	public $splitRate;

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

	/**
	 * @return mixed
	 */
	public function getSplitValue() {
		return $this->splitValue;
	}

	/**
	 * @param mixed $splitValue
	 */
	public function setSplitValue($splitValue) {
		$this->splitValue = $splitValue;
	}

	/**
	 * @return mixed
	 */
	public function getTransactionValue() {
		return $this->transactionValue;
	}

	/**
	 * @param mixed $transactionValue
	 */
	public function setTransactionValue($transactionValue) {
		$this->transactionValue = $transactionValue;
	}

	/**
	 * @return mixed
	 */
	public function getAdditionRetention() {
		return $this->additionRetention;
	}

	/**
	 * @param mixed $additionRetention
	 */
	public function setAdditionRetention($additionRetention) {
		$this->additionRetention = $additionRetention;
	}

	/**
	 * @return mixed
	 */
	public function getSplitRate() {
		return $this->splitRate;
	}

	/**
	 * @param mixed $splitRate
	 */
	public function setSplitRate($splitRate) {
		$this->splitRate = $splitRate;
	}
}
