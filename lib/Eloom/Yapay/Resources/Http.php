<?php

/**
 * Class Http
 *
 * @package Yapay\Resources
 */
class Eloom_Yapay_Resources_Http {

	/**
	 *
	 * @var
	 *
	 */
	protected $status;

	/**
	 *
	 * @var
	 *
	 */
	protected $response;

	/**
	 * Http constructor.
	 */
	public function __construct() {
		if (!function_exists('curl_init')) {
			throw new \Exception('Yapay Library: cURL library is required.');
		}
	}

	/**
	 *
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 *
	 * @param
	 *          $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 *
	 * @param
	 *          $response
	 */
	public function setResponse($response) {
		$this->response = $response;
	}

	/**
	 *
	 * @param
	 *          $url
	 * @param array $data
	 * @param int $timeout
	 * @param string $charset
	 * @return bool
	 * @throws \Exception
	 */
	public function post($url, array $data = array(), $timeout = 20, $charset = 'ISO-8859-1') {
		return $this->curlConnection('POST', $url, $timeout, $charset, $data);
	}

	/**
	 *
	 * @param
	 *          $url
	 * @param int $timeout
	 * @param string $charset
	 * @return bool
	 * @throws \Exception
	 */
	public function get($url, $timeout = 20, $charset = 'ISO-8859-1') {
		return $this->curlConnection('GET', $url, $timeout, $charset, null);
	}

	/**
	 *
	 * @param
	 *          $method
	 * @param
	 *          $url
	 * @param
	 *          $timeout
	 * @param
	 *          $charset
	 * @param array|null $data
	 * @return bool
	 * @throws \Exception
	 */
	protected function curlConnection($method, $url, $timeout, $charset, array $data = null) {
		if (strtoupper($method) === 'POST') {
			$postFields = ($data ? http_build_query($data, '', '&') : "");
			$contentLength = "Content-length: " . strlen($postFields);
			$methodOptions = array(
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $postFields
			);
		} else {
			$contentLength = null;
			$methodOptions = array(
				CURLOPT_HTTPGET => true
			);
		}

		$options = array(
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded; charset=" . $charset,
				$contentLength,
				'lib-description: élOOm Commerce:' . Eloom_Yapay_Library::libraryVersion(),
				'language-engine-description: php:' . Eloom_Yapay_Library::phpVersion()
			),
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_CONNECTTIMEOUT => $timeout
		)// CURLOPT_TIMEOUT => $timeout
		;

		if (!is_null(Eloom_Yapay_Library::moduleVersion()->getRelease())) {
			array_push($options [CURLOPT_HTTPHEADER], sprintf('module-description: %s', Eloom_Yapay_Library::moduleVersion()->getName()));
			array_push($options [CURLOPT_HTTPHEADER], sprintf('module-version: %s', Eloom_Yapay_Library::moduleVersion()->getRelease()));
		}

		if (!is_null(Eloom_Yapay_Library::cmsVersion()->getRelease())) {
			array_push($options [CURLOPT_HTTPHEADER], sprintf('cms-description: %s :%s', Eloom_Yapay_Library::cmsVersion()->getName(), Eloom_Yapay_Library::cmsVersion()->getRelease()));
		}

		$options = ($options + $methodOptions);
		$curl = curl_init();
		curl_setopt_array($curl, $options);
		$resp = curl_exec($curl);
		$info = curl_getinfo($curl);
		$error = curl_errno($curl);
		$errorMessage = curl_error($curl);
		curl_close($curl);
		$this->setStatus((int)$info ['http_code']);
		$this->setResponse((string)$resp);

		if ($error) {
			throw new \Exception("CURL can't connect: $errorMessage");
		}

		return true;
	}
}
