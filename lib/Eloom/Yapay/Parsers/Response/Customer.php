<?php

/**
 * Class Customer
 * @package Yapay\Parsers\Response
 */
trait Eloom_Yapay_Parsers_Response_Customer {

	/**
	 * @var
	 */
	public $customer;

	/**
	 * @return mixed
	 */
	public function getCustomer() {
		return $this->customer;
	}

	/**
	 * @param $customer
	 * @return $this
	 */
	public function setCustomer($data) {
		$customer = new Eloom_Yapay_Domains_Customer();
		$this->customer = $customer->setName($data->name)
			->setCompanyName($data->company_name)
			->setTradeName($data->trade_name)
			->setCnpj($data->cnpj);

		return $this;
	}

}
