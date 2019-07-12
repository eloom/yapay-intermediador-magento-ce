<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_PreApproval_Search {

	/**
	 * @return string
	 */
	public function buildSearchRequestUrl() {
		return Eloom_Yapay_Resources_Builder_PreApproval_Search::getSearchRequestUrl();
	}

}
