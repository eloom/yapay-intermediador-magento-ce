<?php

/**
 * Class Unauthorized
 * @package Yapay\Services\Connection\HttpMethods
 */
class Eloom_Yapay_Resources_Responsibility_Http_Methods_Unauthorized implements Eloom_Yapay_Resources_Responsibility_Handler {

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
	 * @throws \Exception
	 */
	public function handler($http, $class) {
		if ($http->getStatus() == Eloom_Yapay_Enum_Http_Status::UNAUTHORIZED) {
			$error = $class::error($http);
			throw new \Exception($error->getMessage(), $error->getCode());
		}
		return $this->successor->handler($http, $class);
	}

}
