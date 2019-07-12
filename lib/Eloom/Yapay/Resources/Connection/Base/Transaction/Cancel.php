<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_Transaction_Cancel {

	/**
	 * @return string
	 */
	public function buildCancelRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Transaction_Cancel::getCancelUrl();
	}

}
