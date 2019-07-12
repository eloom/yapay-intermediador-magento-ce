<?php

/**
 * Class Request
 * @package Yapay\Domains\Requests
 */
class Eloom_Yapay_Domains_Requests_Checkout_Payment_Request implements Eloom_Yapay_Domains_Requests_Requests {

	use Eloom_Yapay_Domains_Requests_PaymentMethod_Accepted {
		Eloom_Yapay_Domains_Requests_PaymentMethod_Accepted::accept as acceptPaymentMethod;
		Eloom_Yapay_Domains_Requests_PaymentMethod_Accepted::exclude as excludePaymentMethod;
		Eloom_Yapay_Domains_Requests_PaymentMethod_Accepted::getAttributeMap as acceptedPaymentMethods;
	}
	use Eloom_Yapay_Domains_Requests_Currency;
	use Eloom_Yapay_Domains_Requests_Item;
	use Eloom_Yapay_Domains_Requests_Metadata;
	use Eloom_Yapay_Domains_Requests_Notification {
		Eloom_Yapay_Domains_Requests_Notification::getUrl as getNotificationUrl;
		Eloom_Yapay_Domains_Requests_Notification::setUrl as setNotificationUrl;
	}
	use Eloom_Yapay_Domains_Requests_Parameter;
	use Eloom_Yapay_Domains_Requests_PaymentMethod;
	use Eloom_Yapay_Domains_Requests_PreApproval_PreApproval;
	use Eloom_Yapay_Domains_Requests_Customer;
	use Eloom_Yapay_Domains_Requests_Shipping;
	use Eloom_Yapay_Domains_Requests_Reference;
	use Eloom_Yapay_Domains_Requests_Redirect {
		Eloom_Yapay_Domains_Requests_Redirect::getUrl as getRedirectUrl;
		Eloom_Yapay_Domains_Requests_Redirect::setUrl as setRedirectUrl;
		Eloom_Yapay_Domains_Requests_Redirect::getUrl insteadof Eloom_Yapay_Domains_Requests_Notification;
		Eloom_Yapay_Domains_Requests_Redirect::setUrl insteadof Eloom_Yapay_Domains_Requests_Notification;
	}
	use Eloom_Yapay_Domains_Requests_Review {
		Eloom_Yapay_Domains_Requests_Review::getUrl as getReviewUrl;
		Eloom_Yapay_Domains_Requests_Review::setUrl as setReviewUrl;
		Eloom_Yapay_Domains_Requests_Review::getUrl insteadof Eloom_Yapay_Domains_Requests_Redirect;
		Eloom_Yapay_Domains_Requests_Review::setUrl insteadof Eloom_Yapay_Domains_Requests_Redirect;
	}
}
