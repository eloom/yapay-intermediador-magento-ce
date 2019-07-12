<?php

/**
 * Class Payment
 * @package Yapay\Resources\Builder
 */
class Eloom_Yapay_Resources_Builder_Transaction_Search extends Eloom_Yapay_Resources_Builder {

	/**
	 * @return string
	 */
	public static function getSearchRequestUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'transaction/search');
	}

}
