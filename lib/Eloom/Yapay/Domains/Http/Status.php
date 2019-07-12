<?php

class Eloom_Yapay_Domains_Http_Status {

	/**
	 *
	 * @param
	 *          $status
	 * @return integer
	 */
	public function getStatus($status) {
		return \Yapay\Enum\Http\Status::getValue($status);
	}

	/**
	 *
	 * @param
	 *          $type
	 * @return string
	 */
	public function getType($type) {
		return \Yapay\Enum\Http\Status::getValue($type);
	}
}
