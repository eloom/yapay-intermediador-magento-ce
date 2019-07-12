<?php

use Yapay\Domains\Requests\Currency;
use Yapay\Domains\Requests\DirectPayment\Mode;
use Yapay\Domains\Requests\DirectPayment\Customer;
use Yapay\Domains\Requests\Item;
use Yapay\Domains\Requests\Notification;
use Yapay\Domains\Requests\ReceiverEmail;
use Yapay\Domains\Requests\Redirect;
use Yapay\Domains\Requests\Reference;
use Yapay\Domains\Requests\Requests;
use Yapay\Domains\Requests\Shipping;
use Yapay\Domains\Requests\Split;

/**
 * Class Request
 * @package Yapay\Domains\Requests\DirectPayment\OnlineDebit
 */
class Eloom_Yapay_Domains_Requests_DirectPayment_OnlineDebit_Request implements Requests {
	use Currency;
	use Item;
	use Mode;
	use Notification {
		Notification::getUrl as getNotificationUrl;
		Notification::setUrl as setNotificationUrl;
		Notification::getUrl insteadof Redirect;
		Notification::setUrl insteadof Redirect;
	}
	use ReceiverEmail;
	use Customer;
	use Shipping;
	use Split;
	use Reference;
	use Redirect {
		Redirect::getUrl as getRedirectUrl;
		Redirect::setUrl as setRedirectUrl;
	}
}
