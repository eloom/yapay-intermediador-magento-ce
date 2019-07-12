<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_PreApproval_Cancel {

	/**
	 * @return string
	 */
	public function buildPreApprovalCancelUrl() {
		return Eloom_Yapay_Resources_Builder_PreApproval_Cancel::getCancelUrl();
	}

}
