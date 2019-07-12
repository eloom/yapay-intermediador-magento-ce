<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_Transaction_Abandoned {

	/**
	 * @return string
	 */
	public function buildAbandonedRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Transaction_Abandoned::getRequestUrl();
	}

}
