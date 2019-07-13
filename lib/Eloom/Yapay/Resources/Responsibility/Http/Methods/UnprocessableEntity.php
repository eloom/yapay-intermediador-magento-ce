<?php

/**
 * Class Unauthorized
 * @package Yapay\Services\Connection\HttpMethods
 */
class Eloom_Yapay_Resources_Responsibility_Http_Methods_UnprocessableEntity implements Eloom_Yapay_Resources_Responsibility_Handler {


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
		if ($http->getStatus() == Eloom_Yapay_Enum_Http_Status::UNPROCESSABLE_ENTITY) {
			$error = $class::error($http);
			$parser = new Eloom_Yapay_Helpers_Json($error->getMessage());
			$data = $parser->getResult('error_response');
			$errors = [];

			if (isset($data['validation_errors']) && is_array($data['validation_errors'])) {
				foreach ($data['validation_errors'] as $key => $value) {
					if (isset($value['code']) && isset($value['message'])) {
						if (isset($value['message_complete'])) {
							$errors[] = $value['message_complete'];
						} else {
							$error = new Eloom_Yapay_Errors($value['code']);
							$errors[] = $error->getFullMessage();
						}
					}
				}
			}

			if (isset($data['general_errors']) && is_array($data['general_errors'])) {
				foreach ($data['general_errors'] as $key => $value) {
					if (isset($value['code']) && isset($value['message'])) {
							$error = new Eloom_Yapay_Errors($value['code']);
							$errors[] = $error->getFullMessage();
					}
				}
			}

			throw new Eloom_Yapay_UnprocessableEntityException($error->getMessage(), $error->getCode(), $errors);
		}

		return $this->successor->handler($http, $class);
	}


}
