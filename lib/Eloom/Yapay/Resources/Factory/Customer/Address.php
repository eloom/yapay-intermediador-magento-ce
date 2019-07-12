<?php

/**
 * Class Shipping
 * @package Yapay\Resources\Factory\Request
 */
class Eloom_Yapay_Resources_Factory_Customer_Address {

	/**
	 * @var \Yapay\Domains\Shipping
	 */
	private $customer;

	/**
	 * Shipping constructor.
	 * @param $shipping
	 */
	public function __construct($customer) {
		$this->customer = $customer;
	}

	/**
	 * @param \Yapay\Domains\Addres $address
	 * @return \Yapay\Domains\Shipping
	 */
	public function instance(\Yapay\Domains\Address $address) {
		$this->customer->setAddress($address);
		return $this->customer;
	}

	/**
	 * @param $array
	 * @return \Yapay\Domains\Shipping
	 */
	public function withArray($array) {
		$properties = new Eloom_Yapay_Enum_Properties_Current();
		$address = new Eloom_Yapay_Domains_Address();
		$address->setPostalCode($array[$properties::ADDRESS_POSTAL_CODE])
			->setStreet($array[$properties::ADDRESS_STREET])
			->setNumber($array[$properties::ADDRESS_NUMBER])
			->setComplement($array[$properties::ADDRESS_COMPLEMENT])
			->setDistrict($array[$properties::ADDRESS_DISTRICT])
			->setCity($array[$properties::ADDRESS_NUMBER])
			->setState($array[$properties::ADDRESS_STATE])
			->setCountry($array[$properties::ADDRESS_COUNTRY]);
		$this->customer->setAddress($address);
		return $this->customer;
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
	 * @return \Yapay\Domains\Shipping
	 */
	public function withParameters(
		$street, $number, $district, $postalCode, $city, $state, $country, $complement = null
	) {
		$address = new Eloom_Yapay_Domains_Address();
		$address->setPostalCode($postalCode)
			->setStreet($street)
			->setNumber($number)
			->setComplement($complement)
			->setDistrict($district)
			->setCity($city)
			->setState($state)
			->setCountry($country);
		$this->customer->setAddress($address);
		return $this->customer;
	}

}
