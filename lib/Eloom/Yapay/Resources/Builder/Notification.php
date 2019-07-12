<?php


/**
 * Class Payment
 * @package Yapay\Resources\Builder
 */
class Eloom_Yapay_Resources_Builder_Notification extends Eloom_Yapay_Resources_Builder {

	/**
	 * @return string
	 */
	public static function getTransactionRequestUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'notification/transaction');
	}

	/**
	 * @return string
	 */
	public static function getAuthorizationRequestUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'notification/application');
	}

	/**
	 * @return string
	 */
	public static function getPreApprovalRequestUrl() {
		return parent::getRequest(parent::getUrl('webservice'), 'notification/preApproval');
	}

}
