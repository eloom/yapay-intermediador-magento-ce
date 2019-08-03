<?php

trait Eloom_Yapay_Resources_Connection_Base_Authorization_Create {

	/**
	 * @return string
	 */
	public function buildResselerAuthorizationsUrl() {
		return Eloom_Yapay_Resources_Builder_Authorizations_Authorization::getResselerAuthorizationsUrl();
	}

}
