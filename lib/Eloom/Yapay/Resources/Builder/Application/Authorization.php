<?php

/**
 * Class Payment
 * @package Yapay\Resources\Builder
 */
class Eloom_Yapay_Resources_Builder_Application_Authorization extends Eloom_Yapay_Resources_Builder {

	/**
	 * @return string
	 */
	public static function getRequestUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'application/authorization');
	}

	/**
	 * @return string
	 */
	public static function getResponseUrl() {
		return parent::getResponse(parent::getUrl('base'), 'application/authorization');
	}

}
