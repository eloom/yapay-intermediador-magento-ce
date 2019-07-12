<?php

/**
 * Class Generic
 * @package Yapay\Services\Connection\HttpMethods
 */
class Eloom_Yapay_Resources_Responsibility_Http_Methods_Generic implements Eloom_Yapay_Resources_Responsibility_Handler {

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
	 * @return bool;
	 * @throws \ErrorException
	 */
	public function handler($http, $class) {
		unset($class);
		throw new \ErrorException($http->getResponse(), $http->getStatus());
	}

}
