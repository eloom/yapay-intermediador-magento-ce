<?php

/**
 * Class Module
 *
 * @package Yapay\Resources\Framework
 */
class Eloom_Yapay_Resources_Framework_Module extends Eloom_Yapay_Resources_Framework_Platform_Factory {

	/**
	 *
	 * @return string
	 */
	public function getName() {
		return 'eloom';
	}

	public function getRelease() {
		return '##eloom.versao##';
	}

}
