<?php

/**
 * Class PaymentMethod
 * @package Yapay\Parsers\Response
 */
trait Eloom_Yapay_Parsers_Response_Payment {

	/**
	 * @var
	 */
	public $payment;

	/**
	 * @return mixed
	 */
	public function getPayment() {
		return $this->payment;
	}

	/**
	 * @param $paymentMethod
	 * @return $this
	 */
	public function setPayment($data) {
		if ($data) {
			$payment = new Eloom_Yapay_Domains_Responses_Payment();
			$payment->setPricePayment($data->price_payment);
			$payment->setPriceOriginal($data->price_original);
			$payment->setPaymentResponse($data->payment_response);
			$payment->setUrlPayment($data->url_payment);

			if(isset($data->tid)) {
				$payment->setTid($data->tid);
			}
			if(isset($data->split)) {
				$payment->setSplit($data->split);
			}
			if(isset($data->payment_method_id)) {
				$payment->setPaymentMethodId($data->payment_method_id);
			}
			if(isset($data->payment_method_name)) {
				$payment->setPaymentMethodName($data->payment_method_name);
			}
			if(isset($data->linha_digitavel)) {
				$payment->setLinhaDigitavel($data->linha_digitavel);
			}

			$this->payment = $payment;
		}

		return $this;
	}

}
