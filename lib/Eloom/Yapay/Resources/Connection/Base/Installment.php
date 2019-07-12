<?php

/**
 * Class Installment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_Installment {

	/**
	 * @return string
	 */
	public function buildInstallmentRequestUrl() {
		return Eloom_Yapay_Resources_Builder_Installment::getRequestUrl();
	}

}
