<?php

/**
 * Class ContentManagementSystems
 * @package Yapay\Resources\Framework
 */
class Eloom_Yapay_Resources_Framework_ContentManagementSystems extends Eloom_Yapay_Resources_Framework_Platform_Factory {

	public function getName() {
		return 'magento:' . Mage::getVersion();
	}

}
