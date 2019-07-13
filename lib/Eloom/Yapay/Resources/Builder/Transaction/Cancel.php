<?php

/**
 * Class Payment
 * @package Yapay\Resources\Builder
 */
class Eloom_Yapay_Resources_Builder_Transaction_Cancel extends Eloom_Yapay_Resources_Builder {

	/**
	 * @return string
	 */
	public static function getCancelUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'transaction/cancel');
	}

}
