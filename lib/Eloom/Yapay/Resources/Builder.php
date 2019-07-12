<?php

/**
 * Class Builder
 * @package Yapay\Resources
 */
class Eloom_Yapay_Resources_Builder {

	/**
	 * @return string
	 */
	public static function getBaseUrl() {
		return self::getUrl('base');
	}

	/**
	 * @return string
	 */
	public static function getWebserviceUrl() {
		return self::getUrl('webservice');
	}

	/**
	 * @return string
	 */
	protected static function getResourcesFile() {
		$resources = Mage::getBaseDir('lib') . DS . 'Eloom/Yapay/Configuration/Properties/Resources.xml';

		if (defined('PS_RESOURCES')) {
			$resources = PS_RESOURCES;
		}

		return $resources;
	}

	/**
	 * @param $resource
	 * @param null $protocol
	 * @return string
	 */
	protected static function getUrl($resource, $protocol = null) {
		$xml = simplexml_load_file(self::getResourcesFile());

		if (is_null($protocol)) {
			$protocol = $xml->path->protocol;
		}
		$environment = Eloom_Yapay_Configuration_Configure::getEnvironment()->getEnvironment();
		return sprintf(
			"%s://%s", $protocol, current($xml->path->{$resource}->environment->{$environment})
		);
	}

	/**
	 * @param $url
	 * @param $service
	 * @return string
	 */
	protected static function getRequest($url, $service) {
		return self::getService($url, $service, 'request');
	}

	/**
	 * @param $url
	 * @param $service
	 * @return string
	 */
	protected static function getResponse($url, $service) {
		return self::getService($url, $service, 'response');
	}

	/**
	 * @param $url
	 * @param $service
	 * @param $http
	 * @return string
	 */
	protected static function getService($url, $service, $http) {
		$xml = simplexml_load_file(self::getResourcesFile());

		return sprintf(
			"%s/%s", $url, current(self::getProperties($xml, $service, $http))
		);
	}

	/**
	 * @param $xml
	 * @param $service
	 * @param $http
	 * @return mixed
	 */
	private static function getProperties($xml, $service, $http) {
		$services = explode("/", $service);
		if (isset($services[1])) {
			return $xml->services->{$services[0]}->{$services[1]}->{$http};
		} else {
			return $xml->services->{$service}->{$http};
		}
	}

}
