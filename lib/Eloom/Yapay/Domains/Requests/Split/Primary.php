<?php

/**
 * Class Receiver
 * @package Yapay\Domains\Requests\Split
 */
class Eloom_Yapay_Domains_Requests_Split_Primary {
	/**
	 * @return mixed
	 */
	public function getPrimaryReceiver() {
		return $this->split->primaryReceiver;
	}

	/**
	 * @param mixed $primaryReceiver
	 */
	public function setPrimaryReceiver($primaryReceiver) {
		$this->split->setPrimaryReceiver($primaryReceiver);
	}
}
