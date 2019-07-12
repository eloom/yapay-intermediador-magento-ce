<?php

/**
 * Class Document
 * @package Yapay\Resources\Factory
 */
class Eloom_Yapay_Resources_Factory_Customer_Phone {

	/**
	 * @var \Yapay\Domains\Customer
	 */
	private $customer;

	/**
	 * Document constructor.
	 */
	public function __construct($customer) {
		$this->customer = $customer;
	}

	/**
	 * @param \Yapay\Domains\Phone $document
	 * @return \Yapay\Domains\Customer
	 */
	public function instance(Eloom_Yapay_Domains_Phone $phone) {
		$this->customer->setPhone($phone);
		return $this->customer;
	}

	/**
	 * @param $array
	 * @return \Yapay\Domains\Customer
	 */
	public function withArray($array) {
		$properties = new Eloom_Yapay_Enum_Properties_Current();
		$phone = new Eloom_Yapay_Domains_Phone();
		$phone->setAreaCode($array[$properties::SENDER_PHONE_AREA_CODE])
			->setNumber($array[$properties::SENDER_PHONE_NUMBER]);
		$this->customer->setPhone($phone);
		return $this->customer;
	}

	/**
	 * @param $areaCode
	 * @param $number
	 * @return \Yapay\Domains\Customer
	 */
	public function withParameters($areaCode, $number) {
		$phone = new Eloom_Yapay_Domains_Phone();
		$phone->setAreaCode($areaCode)
			->setNumber($number);
		$this->customer->setPhone($phone);
		return $this->customer;
	}

}
