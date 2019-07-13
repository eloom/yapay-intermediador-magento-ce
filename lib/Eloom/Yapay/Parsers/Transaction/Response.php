<?php

/**
 * Class Response
 * @package Yapay\Parsers\Transaction
 */
class Eloom_Yapay_Parsers_Transaction_Response {

	const SUCCESS = 'success';

	use Eloom_Yapay_Parsers_Response_Payment;
	use Eloom_Yapay_Parsers_Response_Customer;

	public $message;

	public $orderNumber;

	public $free;

	public $transactionId;

	public $statusName;

	public $statusId;

	public $tokenTransaction;

	/**
	 * @return mixed
	 */
	public function getOrderNumber() {
		return $this->orderNumber;
	}

	/**
	 * @param mixed $orderNumber
	 */
	public function setOrderNumber($orderNumber) {
		$this->orderNumber = $orderNumber;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFree() {
		return $this->free;
	}

	/**
	 * @param mixed $free
	 */
	public function setFree($free) {
		$this->free = $free;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTransactionId() {
		return $this->transactionId;
	}

	/**
	 * @param mixed $transactionId
	 */
	public function setTransactionId($transactionId) {
		$this->transactionId = $transactionId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStatusName() {
		return $this->statusName;
	}

	/**
	 * @param mixed $statusName
	 */
	public function setStatusName($statusName) {
		$this->statusName = $statusName;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStatusId() {
		return $this->statusId;
	}

	/**
	 * @param mixed $statusId
	 */
	public function setStatusId($statusId) {
		$this->statusId = $statusId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTokenTransaction() {
		return $this->tokenTransaction;
	}

	/**
	 * @param mixed $tokenTransaction
	 */
	public function setTokenTransaction($tokenTransaction) {
		$this->tokenTransaction = $tokenTransaction;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param mixed $message
	 */
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}

	public function isSuccess() {
		return $this->message == self::SUCCESS;
	}


}
