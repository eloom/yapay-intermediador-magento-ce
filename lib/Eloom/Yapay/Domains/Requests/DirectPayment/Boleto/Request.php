<?php

/**
 * Class Request
 * @package Yapay\Domains\Requests\DirectPayment\OnlineDebit
 */
class Eloom_Yapay_Domains_Requests_DirectPayment_Boleto_Request implements Eloom_Yapay_Domains_Requests_Requests {

	use Eloom_Yapay_Domains_Requests_DirectPayment_Customer;
	use Eloom_Yapay_Domains_Requests_DirectPayment_Addresses;
	use Eloom_Yapay_Domains_Requests_DirectPayment_Transaction;
	use Eloom_Yapay_Domains_Requests_DirectPayment_Billing;
	use Eloom_Yapay_Domains_Requests_Item;
	use Eloom_Yapay_Domains_Requests_Currency;

	use Eloom_Yapay_Domains_Requests_Notification {
		Eloom_Yapay_Domains_Requests_Notification::getUrl as getNotificationUrl;
		Eloom_Yapay_Domains_Requests_Notification::setUrl as setNotificationUrl;
		Eloom_Yapay_Domains_Requests_Notification::getUrl insteadof Eloom_Yapay_Domains_Requests_Redirect;
		Eloom_Yapay_Domains_Requests_Notification::setUrl insteadof Eloom_Yapay_Domains_Requests_Redirect;
	}
	use Eloom_Yapay_Domains_Requests_Shipping;
	use Eloom_Yapay_Domains_Requests_Reference;
	use Eloom_Yapay_Domains_Requests_Redirect {
		Eloom_Yapay_Domains_Requests_Redirect::getUrl as getRedirectUrl;
		Eloom_Yapay_Domains_Requests_Redirect::setUrl as setRedirectUrl;
	}

	use Eloom_Yapay_Domains_Requests_DirectPayment_Token;
	use Eloom_Yapay_Domains_Requests_DirectPayment_FingerPrint;
	use Eloom_Yapay_Domains_Requests_DirectPayment_Payment;
}
