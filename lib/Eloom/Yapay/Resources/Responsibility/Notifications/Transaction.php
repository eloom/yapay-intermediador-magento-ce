<?php

/**
 * Class Transaction
 * @package Yapay\Resources\Responsibility\Notifications
 */
class Eloom_Yapay_Resources_Responsibility_Notifications_Transaction implements Eloom_Yapay_Resources_Responsibility_Notifications_Handler {

	/**
	 * @var
	 */
	private $successor;

	/**
	 * @param $next
	 * @return $this
	 */
	public function successor($next) {
		$this->successor = $next;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function handler() {
		if (!is_null(Eloom_Yapay_Helpers_Xhr::getInputCode()) and !is_null(Eloom_Yapay_Helpers_Xhr::getInputType()) and
			Eloom_Yapay_Helpers_Xhr::getInputType() == Eloom_Yapay_Enum_Notification::TRANSACTION) {
			$notification = Eloom_Yapay_Helpers_NotificationObject::initialize();
			return $notification->getCode();
		}
		return $this->successor->handler();
	}

}
