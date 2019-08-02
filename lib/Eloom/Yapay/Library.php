<?php

/**
 * Class Library
 * @package Yapay
 */
class Eloom_Yapay_Library {

	/**
	 */
	const VERSION = '##eloom.versao##';

	/**
	 *
	 * @var
	 *
	 */
	private static $module;

	/**
	 *
	 * @var
	 *
	 */
	private static $cms;

	/**
	 *
	 * @throws \Exception
	 */
	final public static function initialize() {
		if(!defined(YP_BASEPATH)) {
			define('YP_BASEPATH', __DIR__);
			define('YP_CONFIG_PATH', YP_BASEPATH . "/Configuration/");
			define('YP_CONFIG', YP_CONFIG_PATH . "Properties/Conf.xml");
			define('YP_RESOURCES', YP_CONFIG_PATH . "Properties/Resources.xml");

			self::validate();
			gc_enable();
		}
	}

	/**
	 *
	 * @return bool
	 * @throws \Exception
	 */
	final public static function validate() {
		try {
			Eloom_Yapay_Helpers_Validate::cUrl();
			Eloom_Yapay_Helpers_Validate::simpleXml();
			return true;
		} catch (\Exception $exception) {
			throw new \Exception("Yapay Library PHP component exception", ['PSLE'], $exception);
		}
	}

	/**
	 *
	 * @return string
	 */
	final public static function libraryVersion() {
		return self::VERSION;
	}

	/**
	 *
	 * @return string
	 */
	final public static function phpVersion() {
		return (new Eloom_Yapay_Resources_Framework_Language())->getRelease();
	}

	/**
	 *
	 * @return Module
	 */
	public static function moduleVersion() {
		if (is_null(self::$module)) {
			return self::$module = new Eloom_Yapay_Resources_Framework_Module ();
		}
		return self::$module;
	}

	/**
	 *
	 * @return ContentManagementSystems
	 */
	public static function cmsVersion() {
		if (is_null(self::$cms)) {
			return self::$cms = new Eloom_Yapay_Resources_Framework_ContentManagementSystems ();
		}
		return self::$cms;
	}

}
