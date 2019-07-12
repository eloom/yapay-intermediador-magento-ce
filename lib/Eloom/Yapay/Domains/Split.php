<?php

/**
 * Class Split
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_Split {

	/**
	 * @var
	 */
	private $primaryReceiver;

	/**
	 * @var
	 */
	private $receivers = array();

	/**
	 * @return mixed
	 */
	public function getPrimaryReceiver() {
		return $this->primaryReceiver;
	}

	/**
	 * @param mixed $primaryReceiver
	 */
	public function setPrimaryReceiver($primaryReceiver) {
		$this->primaryReceiver = $primaryReceiver;
	}

	/**
	 * @return mixed
	 */
	public function getReceivers() {
		return $this->receivers;
	}

	/**
	 * @param mixed $receivers
	 */
	public function setReceivers($receivers) {
		if (is_array($receivers)) {
			$arr = array();
			foreach ($receivers as $receiver) {
				if ($receiver instanceof Eloom_Yapay_Domains_Split_Receiver) {
					$arr[] = $receiver;
				}
			}
			$this->receivers[] = $receivers;
		} elseif ($receivers instanceof Eloom_Yapay_Domains_Split_Receiver) {
			$this->receivers[] = $receivers;
		}
	}

}
