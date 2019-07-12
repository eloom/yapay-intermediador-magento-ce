<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_PreApproval_Charge {

	/**
	 * @return string
	 */
	public function buildPreApprovalChargeRequestUrl() {
		return Eloom_Yapay_Resources_Builder_PreApproval_Charge::getRequestUrl();
	}

}
