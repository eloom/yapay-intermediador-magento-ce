<?php

trait Eloom_Yapay_Domains_Requests_Transaction_Transaction {

	/**
	 * @return mixed
	 */
	public function getAvailablePaymentMethods() {
		return $this->transaction->availablePaymentMethods;
	}

	/**
	 * @param mixed $availablePaymentMethods
	 */
	public function setAvailablePaymentMethods($availablePaymentMethods) {
		$this->transaction->setAvailablePaymentMethods($availablePaymentMethods);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCustomerIp() {
		return $this->transaction->customerIp;
	}

	/**
	 * @param mixed $customerIp
	 */
	public function setCustomerIp($customerIp) {
		$this->transaction->setCustomerIp($customerIp);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getShippingType() {
		return $this->transaction->shippingType;
	}

	/**
	 * @param mixed $shippingType
	 */
	public function setShippingType($shippingType) {
		$this->transaction->setShippingType($shippingType);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getShippingPrice() {
		return $this->transaction->shippingPrice;
	}

	/**
	 * @param mixed $shippingPrice
	 */
	public function setShippingPrice($shippingPrice) {
		$this->transaction->setShippingPrice($shippingPrice);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPriceDiscount() {
		return $this->transaction->priceDiscount;
	}

	/**
	 * @param mixed $priceDiscount
	 */
	public function setPriceDiscount($priceDiscount) {
		$this->transaction->setPriceDiscount($priceDiscount);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUrlNotification() {
		return $this->transaction->urlNotification;
	}

	/**
	 * @param mixed $urlNotification
	 */
	public function setUrlNotification($urlNotification) {
		$this->transaction->setUrlNotification($urlNotification);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFree() {
		return $this->transaction->free;
	}

	/**
	 * @param mixed $free
	 */
	public function setFree($free) {
		$this->transaction->setFree($free);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPaymentMethodId() {
		return $this->transaction->paymentMethodId;
	}

	/**
	 * @param mixed $free
	 */
	public function setPaymentMethodId($paymentMethodId) {
		$this->transaction->setPaymentMethodId($paymentMethodId);
		return $this;
	}
}