<?php

/**
 * Class Data
 * @package Yapay\Services\Connection
 */
class Eloom_Yapay_Resources_Connection_Data {

	use Eloom_Yapay_Resources_Connection_Base_Application_Authorization;
	use Eloom_Yapay_Resources_Connection_Base_Application_Authorization_Search {
		Eloom_Yapay_Resources_Connection_Base_Application_Authorization_Search::buildSearchRequestUrl as buildAuthorizationSearchRequestUrl;
		Eloom_Yapay_Resources_Connection_Base_Application_Authorization_Search::buildSearchRequestUrl insteadof Eloom_Yapay_Resources_Connection_Base_Transaction_Search;
	}
	use Eloom_Yapay_Resources_Connection_Base_Checkout_Payment;
	use Eloom_Yapay_Resources_Connection_Base_Credentials;
	use Eloom_Yapay_Resources_Connection_Base_DirectPayment_Payment;
	use Eloom_Yapay_Resources_Connection_Base_Installment;
	use Eloom_Yapay_Resources_Connection_Base_Notification;
	use Eloom_Yapay_Resources_Connection_Base_PreApproval_Cancel;
	use Eloom_Yapay_Resources_Connection_Base_PreApproval_Charge;
	use Eloom_Yapay_Resources_Connection_Base_PreApproval_Payment;
	use Eloom_Yapay_Resources_Connection_Base_PreApproval_Search {
		Eloom_Yapay_Resources_Connection_Base_PreApproval_Search::buildSearchRequestUrl as buildPreApprovalSearchRequestUrl;
		Eloom_Yapay_Resources_Connection_Base_PreApproval_Search::buildSearchRequestUrl insteadof Eloom_Yapay_Resources_Connection_Base_Application_Authorization_Search;
	}
	use Eloom_Yapay_Resources_Connection_Base_Refund;
	use Eloom_Yapay_Resources_Connection_Base_Session;
	use Eloom_Yapay_Resources_Connection_Base_Transaction_Abandoned;
	use Eloom_Yapay_Resources_Connection_Base_Transaction_Cancel;
	use Eloom_Yapay_Resources_Connection_Base_Transaction_Search {
		Eloom_Yapay_Resources_Connection_Base_Transaction_Search::buildSearchRequestUrl as buildTransactionSearchRequestUrl;
		Eloom_Yapay_Resources_Connection_Base_Transaction_Search::buildSearchRequestUrl insteadof Eloom_Yapay_Resources_Connection_Base_PreApproval_Search;
	}

	/**
	 * Data constructor.
	 * @param Credentials $credentials
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
