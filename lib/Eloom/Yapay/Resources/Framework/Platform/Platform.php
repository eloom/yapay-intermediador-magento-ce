<?php

/**
 * Interface Platform
 * @package Yapay\Resources\Framework\Platform
 */
interface Eloom_Yapay_Resources_Framework_Platform_Platform {
	/**
	 * @param $name
	 * @return string
	 */
	public function setName($name);

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @param $release
	 * @return string
	 */
	public function setRelease($release);

	/**
	 * @return string
	 */
	public function getRelease();
}
