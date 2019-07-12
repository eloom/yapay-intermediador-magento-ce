<?php

class Eloom_Yapay_Helpers_Validate {
	final public static function cUrl() {
		if (!function_exists('curl_init')) {
			throw new \Exception ('Yapay Library cURL library is required.', '[cURL]');
		}
	}

	final public static function simpleXml() {
		if (!extension_loaded('simplexml')) {
			throw new \Exception ('Yapay Library simple xml is required.', '[SimpleXml]');
		}
	}
}
