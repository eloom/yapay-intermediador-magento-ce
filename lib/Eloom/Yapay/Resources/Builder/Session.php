<?php

/**
 * Class Session
 * @package Yapay\Resources\Builder
 */
class Eloom_Yapay_Resources_Builder_Session extends Eloom_Yapay_Resources_Builder {
	public static function getRequestUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'session');
	}
}
