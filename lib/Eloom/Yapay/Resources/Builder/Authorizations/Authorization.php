<?php


class Eloom_Yapay_Resources_Builder_Authorizations_Authorization extends Eloom_Yapay_Resources_Builder {

	/**
	 * @return string
	 */
	public static function getResselerAuthorizationsUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'authorization/create');
	}

	/**
	 * @return string
	 */
	public static function getAuthorizationsAccessTokenUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'authorization/token');
	}
}