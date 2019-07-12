<?php

class Eloom_Yapay_Domains_Requests_Adapter_DirectPayment_Customer {

	use Eloom_Yapay_Domains_Requests_Customer_Customer;
	use Eloom_Yapay_Domains_Requests_Customer_Document;
	use Eloom_Yapay_Domains_Requests_Customer_Hash;
	use Eloom_Yapay_Domains_Requests_Customer_Ip;
	use Eloom_Yapay_Domains_Requests_Customer_Phone;

	private $customer;

	public function __construct($customer) {
		$this->customer = $customer;
	}

}
