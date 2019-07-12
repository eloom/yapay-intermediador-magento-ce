<?php

/**
 * Description of Parameter
 *
 */
trait Eloom_Yapay_Domains_Requests_Parameter {

	private $parameter;

	public function addParameter() {
		$this->parameter = Eloom_Yapay_Helpers_InitializeObject::Initialize(
			$this->parameter, new Eloom_Yapay_Resources_Factory_Request_Parameter()
		);

		return $this->parameter;
	}

	public function setParameter($parameter) {
		if (is_array($parameter)) {
			$arr = array();
			foreach ($parameter as $key => $parameterItem) {
				if ($parameterItem instanceof Eloom_Yapay_Domains_Parameter) {
					$arr[$key] = $parameterItem;
				} else {
					if (is_array($parameter)) {
						$arr[$key] = new Eloom_Yapay_Domains_Parameter($parameterItem);
					}
				}
			}
			$this->parameter = $arr;
		}
	}

	public function getParameter() {
		return current($this->parameter);
	}

	public function parameterLenght() {
		return (!is_null($this->parameter)) ? count(current($this->parameter)) : 0;
	}

}
