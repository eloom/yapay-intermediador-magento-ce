<?php

class Eloom_Yapay_Domains_Requests_PreApproval extends Eloom_Yapay_Domains_Requests_PreApproval_Request {

	/**
	 * @param $credentials
	 * @return string
	 * @throws \Exception
	 */
	public function register($credentials) {
		return Eloom_Yapay_Services_PreApproval_Payment::create($credentials, $this);
	}

}
