<?php

/**
 * Class Data
 * @package Yapay\Services\Connection
 */
class Eloom_Yapay_Resources_Connection_Data {

	use Eloom_Yapay_Resources_Connection_Base_Checkout_Payment;
	use Eloom_Yapay_Resources_Connection_Base_Credentials;
	use Eloom_Yapay_Resources_Connection_Base_DirectPayment_Payment;
	use Eloom_Yapay_Resources_Connection_Base_Installment;
	use Eloom_Yapay_Resources_Connection_Base_Notification;

	use Eloom_Yapay_Resources_Connection_Base_Refund;
	use Eloom_Yapay_Resources_Connection_Base_Session;
	use Eloom_Yapay_Resources_Connection_Base_Transaction_Cancel;
	use Eloom_Yapay_Resources_Connection_Base_Transaction_Search;
	use Eloom_Yapay_Resources_Connection_Base_Authorization_Create;
	use Eloom_Yapay_Resources_Connection_Base_Authorization_Token;

	/**
	 * Data constructor.
	 * @param Eloom_Yapay_Domains_Account_Credentials $credentials
	 */
	public function __construct(Eloom_Yapay_Domains_Account_Credentials $credentials) {
		$this->setCredentials($credentials);
	}

	/**
	 * @param $data
	 * @return string
	 */
	public function buildHttpUrl($data) {
		return http_build_query($data);
	}

}
