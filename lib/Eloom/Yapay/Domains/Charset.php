<?php

/**
 * Created by PhpStorm.
 * User: esilva
 * Date: 09/03/16
 * Time: 13:55
 */
class Eloom_Yapay_Domains_Charset {

	/**
	 * @var
	 */
	private $encoding;

	/**
	 * @return string
	 */
	public function getEncoding() {
		return $this->encoding;
	}

	/**
	 * @param $encoding
	 */
	public function setEncoding($encoding) {
		$this->encoding = $encoding;
	}

}
