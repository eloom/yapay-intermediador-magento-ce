<?php

use Yapay\Domains\Requests\DirectPayment\OnlineDebit\Request;

/**
 * Class Payment
 * @package Yapay\Domains\Requests\DirectPayment
 */
class Eloom_Yapay_Domains_Requests_DirectPayment_OnlineDebit extends Request {
	/**
	 * @var string bank name
	 */
	private $bankName;

	/**
	 * @return string bank name
	 */
	public function getBankName() {
		return $this->bankName;
	}

	/**
	 * @param $bankName
	 * @return $this
	 */
	public function setBankName($bankName) {
		$this->bankName = $bankName;
		return $this;
	}

	/**
	 * @param $credentials
	 * @return string
	 * @throws \Exception
	 */
	public function register($credentials) {
		return \Yapay\Services\DirectPayment\OnlineDebit::checkout($credentials, $this);
	}
}
