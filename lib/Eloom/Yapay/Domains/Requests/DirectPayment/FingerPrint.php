<?php

/**
 * Domain request class of Token
 *
 * @package Yapay\Domains\Requests\DirectPayment
 */
trait Eloom_Yapay_Domains_Requests_DirectPayment_FingerPrint {

	private $fingerPrint;

	public function getFingerPrint() {
		return $this->fingerPrint;
	}

	public function setFingerPrint($fingerPrint) {
		$this->fingerPrint = $fingerPrint;
		return $this;
	}

}
