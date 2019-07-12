<?php

/**
 * Class Payment
 * @package Yapay\Services\Connection\Base
 */
trait Eloom_Yapay_Resources_Connection_Base_PreApproval_Payment {

	/**
	 * @return string
	 */
	public function buildPreApprovalRequestUrl() {
		return Eloom_Yapay_Resources_Builder_PreApproval_Payment::getRequestUrl();
	}

	/**
	 * @return string
	 */
	public function buildPreApprovalResponseUrl() {
		return Eloom_Yapay_Resources_Builder_PreApproval_Payment::getResponseUrl();
	}

}
