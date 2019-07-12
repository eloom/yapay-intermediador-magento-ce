<?php

/**
 * Class Factory
 * @package Yapay\Resources\Framework\Platform
 */
class Eloom_Yapay_Resources_Framework_Platform_Factory {

	/**
	 *
	 * @var
	 *
	 */
	private $name;

	/**
	 *
	 * @var
	 *
	 */
	private $release;

	/**
	 *
	 * @param
	 *          $name
	 * @return $this
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 *
	 * @param
	 *          $release
	 * @return $this
	 */
	public function setRelease($release) {
		$this->release = $release;
		return $this;
	}

	/**
	 *
	 * @return string
	 */
	public function getRelease() {
		return $this->release;
	}

}
