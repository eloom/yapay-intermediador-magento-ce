<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_Notification {

	/**
	 * @return string
	 */
	public function buildNotificationTransactionRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Notification::getTransactionRequestUrl();
	}

	/**
	 * @return string
	 */
	public function buildNotificationAuthorizationRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Notification::getAuthorizationRequestUrl();
	}

	/**
	 * @return string
	 */
	public function buildNotificationPreApprovalRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Notification::getPreApprovalRequestUrl();
	}

}
