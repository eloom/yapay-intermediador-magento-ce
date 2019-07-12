<?php

/**
 * Class Request
 * @package Yapay\Domains\Requests
 */
class Eloom_Yapay_Domains_Requests_Application_Authorization_Request implements Eloom_Yapay_Domains_Requests_Requests {
	use Eloom_Yapay_Domains_Requests_Notification {
		Eloom_Yapay_Domains_Requests_Notification::getUrl as getNotificationUrl;
		Eloom_Yapay_Domains_Requests_Notification::setUrl as setNotificationUrl;
		Eloom_Yapay_Domains_Requests_Notification::getUrl insteadof Eloom_Yapay_Domains_Requests_Redirect;
		Eloom_Yapay_Domains_Requests_Notification::setUrl insteadof Eloom_Yapay_Domains_Requests_Redirect;
	}
	use Eloom_Yapay_Domains_Requests_Permissions;
	use Eloom_Yapay_Domains_Requests_Reference;
	use Eloom_Yapay_Domains_Requests_Redirect {
		Eloom_Yapay_Domains_Requests_Redirect::getUrl as getRedirectUrl;
		Eloom_Yapay_Domains_Requests_Redirect::setUrl as setRedirectUrl;
	}
}
