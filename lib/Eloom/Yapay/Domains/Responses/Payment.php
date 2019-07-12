<?php

/**
 * Class PaymentMethod
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_Responses_Payment {

	public $pricePayment;

	public $priceOriginal;

	public $paymentResponse;

	public $urlPayment;

	public $tid;

	public $split;

	public $paymentMethodId;

	public $paymentMethodName;

	public $linhaDigitavel;

	/**
	 * @return mixed
	 */
	public function getPricePayment() {
		return $this->pricePayment;
	}

	/**
	 * @param mixed $pricePayment
	 */
	public function setPricePayment($pricePayment) {
		$this->pricePayment = $pricePayment;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPriceOriginal() {
		return $this->priceOriginal;
	}

	/**
	 * @param mixed $priceOriginal
	 */
	public function setPriceOriginal($priceOriginal) {
		$this->priceOriginal = $priceOriginal;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPaymentResponse() {
		return $this->paymentResponse;
	}

	/**
	 * @param mixed $paymentResponse
	 */
	public function setPaymentResponse($paymentResponse) {
		$this->paymentResponse = $paymentResponse;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUrlPayment() {
		return $this->urlPayment;
	}

	/**
	 * @param mixed $urlPayment
	 */
	public function setUrlPayment($urlPayment) {
		$this->urlPayment = $urlPayment;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTid() {
		return $this->tid;
	}

	/**
	 * @param mixed $tid
	 */
	public function setTid($tid) {
		$this->tid = $tid;
		return $this;
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
		return $this;
	}

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
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPaymentMethodName() {
		return $this->paymentMethodName;
	}

	/**
	 * @param mixed $paymentMethodName
	 */
	public function setPaymentMethodName($paymentMethodName) {
		$this->paymentMethodName = $paymentMethodName;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLinhaDigitavel() {
		return $this->linhaDigitavel;
	}

	/**
	 * @param mixed $linhaDigitavel
	 */
	public function setLinhaDigitavel($linhaDigitavel) {
		$this->linhaDigitavel = $linhaDigitavel;
		return $this;
	}


}
