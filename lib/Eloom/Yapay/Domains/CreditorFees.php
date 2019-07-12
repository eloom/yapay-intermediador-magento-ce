<?php

/**
 * Class CreditorFees
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_CreditorFees {

	/**
	 * @var
	 */
	private $intermediationRateAmount;

	/**
	 * @var
	 */
	private $intermediationFeeAmount;

	/**
	 * @return mixed
	 */
	public function getIntermediationFeeAmount() {
		return $this->intermediationFeeAmount;
	}

	/**
	 * @param mixed $intermediationFeeAmount
	 * @return CreditorFees
	 */
	public function setIntermediationFeeAmount($intermediationFeeAmount) {
		$this->intermediationFeeAmount = $intermediationFeeAmount;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIntermediationRateAmount() {
		return $this->intermediationRateAmount;
	}

	/**
	 * @param mixed $intermediationRateAmount
	 * @return CreditorFees
	 */
	public function setIntermediationRateAmount($intermediationRateAmount) {
		$this->intermediationRateAmount = $intermediationRateAmount;
		return $this;
	}

}
