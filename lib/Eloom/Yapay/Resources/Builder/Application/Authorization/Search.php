<?php

/**
 * Class Payment
 * @package Yapay\Resources\Builder
 */
class Eloom_Yapay_Resources_Builder_Application_Authorization_Search extends Eloom_Yapay_Resources_Builder {

	/**
	 * @return string
	 */
	public static function getSearchRequestUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'application/search');
	}

}
