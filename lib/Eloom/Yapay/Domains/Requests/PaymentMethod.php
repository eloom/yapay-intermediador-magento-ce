<?php


trait Eloom_Yapay_Domains_Requests_PaymentMethod {

	private $paymentMethod = array();

	public function addPaymentMethod() {
		$this->paymentMethod = Eloom_Yapay_Helpers_InitializeObject::Initialize(
			$this->paymentMethod, new Eloom_Yapay_Resources_Factory_Request_PaymentMethod()
		);

		return $this->paymentMethod;
	}

	public function setPaymentMethod($paymentMethod) {
		if (is_array($paymentMethod)) {
			$arr = array();
			foreach ($paymentMethod as $key => $method) {
				if ($method instanceof Eloom_Yapay_Domains_PaymentMethod) {
					$arr[$key] = $method;
				} else {
					if (is_array($paymentMethod)) {
						$arr[$key] = new Eloom_Yapay_Domains_PaymentMethod($method);
					}
				}
			}
			$this->paymentMethod = $arr;
		}
	}

	public function getPaymentMethod() {
		return current($this->paymentMethod);
	}

	public function paymentMethodLenght() {
		return count($this->paymentMethod);
	}

}
