<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_Application_Authorization_Search {

	/**
	 * @return string
	 */
	public function buildSearchRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Application_Authorization_Search::getSearchRequestUrl();
	}

}
