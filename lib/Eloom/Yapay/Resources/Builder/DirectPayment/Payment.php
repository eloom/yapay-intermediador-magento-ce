<?php

/**
 * Class Payment
 * @package Yapay\Resources\Builder
 */
class Eloom_Yapay_Resources_Builder_DirectPayment_Payment extends Eloom_Yapay_Resources_Builder {

	/**
	 * @return string
	 */
	public static function getRequestUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'directPayment');
	}

}
