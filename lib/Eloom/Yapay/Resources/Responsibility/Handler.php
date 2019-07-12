<?php

/**
 * interface Handler
 * @package Yapay\Services\Connection\Responsibility
 */
interface Eloom_Yapay_Resources_Responsibility_Handler {
	/**
	 *
	 * @param
	 *          $next
	 * @return mixed
	 */
	public function successor($next);

	/**
	 *
	 * @param \Yapay\Resources\Http $http
	 * @param
	 *          $class
	 * @return mixed
	 */
	public function handler($action, $class);
}
