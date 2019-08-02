<?php

class Eloom_Yapay_Helpers_Json {

	private $json;

	public function __construct($json) {
		$this->json = json_decode($json, true);
	}

	public function getResult($node = null) {
		if ($node) {
			if (isset($this->json[$node])) {
				return $this->json[$node];
			}
		} else {
			return $this->json;
		}
	}
}
