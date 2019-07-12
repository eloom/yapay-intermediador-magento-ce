<?php

/**
 * Class Shipping
 * @package Yapay\Resources\Factory\Request
 */
class Eloom_Yapay_Resources_Factory_Request_DirectPayment_CreditCard_Billing_Address {

	/**
	 * @var \Yapay\Domains\DirectPayment\CreditCard\Billing
	 */
	private $billing;

	/**
	 * Shipping constructor.
	 * @param $billing
	 */
	public function __construct($billing) {
		$this->billing = $billing;
	}

	/**
	 * @param \Yapay\Domains\Address $address
	 * @return \Yapay\Domains\DirectPayment\CreditCard\Billing
	 */
	public function instance(Eloom_Yapay_Domains_Address $address) {
		$this->billing->setAddress($address);
		return $this->billing;
	}

	/**
	 * @param $array
	 * @return \Yapay\Domains\DirectPayment\CreditCard\Billing
	 */
	public function withArray($array) {
		$properties = new Eloom_Yapay_Enum_Properties_Current();
		$address = new Eloom_Yapay_Domains_Address();
		$address->setType($array[$properties::ADDRESS_TYPE])
			->setPostalCode($array[$properties::ADDRESS_POSTAL_CODE])
			->setStreet($array[$properties::ADDRESS_STREET])
			->setNumber($array[$properties::ADDRESS_NUMBER])
			->setComplement($array[$properties::ADDRESS_COMPLEMENT])
			->setDistrict($array[$properties::ADDRESS_DISTRICT])
			->setCity($array[$properties::ADDRESS_NUMBER])
			->setState($array[$properties::ADDRESS_STATE])
			->setCountry($array[$properties::ADDRESS_COUNTRY]);
		$this->billing->setAddress($address);
		return $this->billing;
	}

	/**
	 * @param $street
	 * @param $number
	 * @param null $complement
	 * @param $district
	 * @param $postalCode
	 * @param $city
	 * @param $state
	 * @param $country
	 * @return \Yapay\Domains\DirectPayment\CreditCard\Billing
	 */
	public function withParameters(
		$type, $street, $number, $district, $postalCode, $city, $state, $country, $complement = null
	) {
		$address = new Eloom_Yapay_Domains_Address();
		$address->setType($type)
			->setPostalCode($postalCode)
			->setStreet($street)
			->setNumber($number)
			->setComplement($complement)
			->setDistrict($district)
			->setCity($city)
			->setState($state)
			->setCountry($country);
		$this->billing->setAddress($address);
		return $this->billing;
	}

}
