<?php

/**
 * Class NotificationObject
 * @package Yapay\Helpers
 */
class Eloom_Yapay_Helpers_NotificationObject {

	/**
	 * @return $this
	 */
	public static function initialize() {
		$notification = new Eloom_Yapay_Domains_Notification();
		$notification->setCode(Eloom_Yapay_Helpers_Xhr::getInputCode())
			->setType(Eloom_Yapay_Helpers_Xhr::getInputType());
		return $notification;
	}

}
