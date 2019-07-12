<?php


/**
 * Interface Handler
 * @package Yapay\Resources\Responsibility\Notifications
 */
interface Eloom_Yapay_Resources_Responsibility_Notifications_Handler {

	/**
	 * @param $next
	 * @return mixed
	 */
	public function successor($next);

	/**
	 * @return mixed
	 */
	public function handler();
}
