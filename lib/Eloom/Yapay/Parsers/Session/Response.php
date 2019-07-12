<?php

/**
 * Class Response
 *
 */
class Eloom_Yapay_Parsers_Session_Response {
	/**
	 * @var
	 */
	private $result;

	/**
	 * @return mixed
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * @param mixed $result
	 * @return Response
	 */
	public function setResult($result) {
		$this->result = $result;
	}
}
