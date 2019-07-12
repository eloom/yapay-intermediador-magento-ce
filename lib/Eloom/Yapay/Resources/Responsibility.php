<?php

/**
 * class Handler
 * @package Yapay\Services\Connection\Responsibility
 */
class Eloom_Yapay_Resources_Responsibility {

	public static function http($http, $class) {
		$success = new Eloom_Yapay_Resources_Responsibility_Http_Methods_Success();
		$request = new Eloom_Yapay_Resources_Responsibility_Http_Methods_Request();
		$unauthorized = new Eloom_Yapay_Resources_Responsibility_Http_Methods_Unauthorized();
		$unprocessableEntity = new Eloom_Yapay_Resources_Responsibility_Http_Methods_UnprocessableEntity();
		$generic = new Eloom_Yapay_Resources_Responsibility_Http_Methods_Generic();

		$success->successor($request->successor($unprocessableEntity->successor($unauthorized->successor($generic))));
		return $success->handler($http, $class);
	}

	public static function configuration() {
		$environment = new Eloom_Yapay_Resources_Responsibility_Configuration_Environment();
		$extensible = new Eloom_Yapay_Resources_Responsibility_Configuration_Extensible();
		$file = new Eloom_Yapay_Resources_Responsibility_Configuration_File();
		$wrapper = new Eloom_Yapay_Resources_Responsibility_Configuration_Wrapper();

		$wrapper->successor($environment->successor($file->successor($extensible)));
		return $wrapper->handler(null, null);
	}

	public static function notifications() {
		$transaction = new Eloom_Yapay_Resources_Responsibility_Notifications_Transaction();
		$preApproval = new Eloom_Yapay_Resources_Responsibility_Notifications_PreApproval();
		$application = new Eloom_Yapay_Resources_Responsibility_Notifications_Application();

		$transaction->successor($preApproval->successor($application));

		return $transaction->handler();
	}

}
