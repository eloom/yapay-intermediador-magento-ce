<?php

/**
 * Class Receiver
 * @package Yapay\Domains\Requests\Split
 */
class Eloom_Yapay_Domains_Requests_Split_Receiver {
	/**
	 * @var
	 */
	private $receivers;

	/**
	 * @return object
	 */
	public function addReceiver() {
		$this->receivers = new \Yapay\Resources\Factory\Split\Receiver($this->split);
		return $this->receivers;
	}

	/**
	 * @param $receivers
	 */
	public function setReceivers($receivers) {
		if (is_array($receivers)) {
			$arr = array();
			foreach ($receivers as $key => $receiver) {
				if ($receiver instanceof \Yapay\Domains\Split\Receiver) {
					$arr[$key] = $receiver;
				} else {
					if (is_array($receiver)) {
						$arr[$key] = new \Yapay\Domains\Split\Receiver($receiver);
					}
				}
			}
			$this->receivers = $arr;
		}
	}

	/**
	 * @return mixed
	 */
	public function getReceivers() {
		return current($this->receivers);
	}

	/**
	 * @return int
	 */
	public function receiverLenght() {
		return count(current($this->receivers));
	}
}
