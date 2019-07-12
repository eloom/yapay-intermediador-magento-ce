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
			$payment->setTid($data->tid);
			$payment->setSplit($data->split);
			$payment->setPaymentMethodId($data->payment_method_id);
			$payment->setPaymentMethodName($data->payment_method_name);
			$payment->setLinhaDigitavel($data->linha_digitavel);

			$this->payment = $payment;
		}

		return $this;
	}

}
