<?php

/**
 * Class Success
 * @package Yapay\Services\Connection\HttpMethods
 */
class Eloom_Yapay_Resources_Responsibility_Http_Methods_Success implements Eloom_Yapay_Resources_Responsibility_Handler {

	/**
	 * @var
	 */
	private $successor;

	/**
	 * @param $successor
	 * @return $this
	 */
	public function successor($successor) {
		$this->successor = $successor;
		return $this;
	}

	/**
	 * @param Http $http
	 * @param $class
	 * @return mixed
	 */
	public function handler($http, $class) {
		if ($http->getStatus() == Eloom_Yapay_Enum_Http_Status::OK || $http->getStatus() == Eloom_Yapay_Enum_Http_Status::CREATED) {
			return $class::success($http);
		}
		return $this->successor->handler($http, $class);
	}

}
