<?php

/**
 * Class Document
 * @package Yapay\Resources\Factory
 */
class Eloom_Yapay_Resources_Factory_Request_DirectPayment_CreditCard_Holder_Phone {

	/**
	 * @var \Yapay\Domains\DirectPayment\CreditCard\Holder
	 */
	private $holder;

	/**
	 * Document constructor.
	 */
	public function __construct($holder) {
		$this->holder = $holder;
	}

	/**
	 * @param \Yapay\Domains\Phone $phone
	 * @return \Yapay\Domains\DirectPayment\CreditCard\Holder
	 */
	public function instance(Eloom_Yapay_Domains_Phone $phone) {
		$this->holder->setPhone($phone);
		return $this->holder;
	}

	/**
	 * @param $array
	 * @return \Yapay\Domains\DirectPayment\CreditCard\Holder
	 */
	public function withArray($array) {
		$properties = new Eloom_Yapay_Enum_Properties_Current();
		$phone = new Eloom_Yapay_Domains_Phone();
		$phone->setAreaCode($array[$properties::SENDER_PHONE_AREA_CODE])
			->setNumber($array[$properties::SENDER_PHONE_NUMBER]);
		$this->holder->setPhone($phone);
		return $this->holder;
	}

	/**
	 * @param $areaCode
	 * @param $number
	 * @return \Yapay\Domains\DirectPayment\CreditCard\Holder
	 */
	public function withParameters($areaCode, $number) {
		$phone = new Eloom_Yapay_Domains_Phone();
		$phone->setAreaCode($areaCode)
			->setNumber($number);
		$this->holder->setPhone($phone);
		return $this->holder;
	}

}
