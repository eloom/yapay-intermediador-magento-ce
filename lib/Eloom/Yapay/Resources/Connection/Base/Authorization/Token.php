<?php

trait Eloom_Yapay_Resources_Connection_Base_Authorization_Token {

	/**
	 * @return string
	 */
	public function buildAuthorizationsAccessTokenUrl() {
		return Eloom_Yapay_Resources_Builder_Authorizations_Authorization::getAuthorizationsAccessTokenUrl();
	}

}
