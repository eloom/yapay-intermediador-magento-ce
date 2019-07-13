<?php


/**
 * Class Customer
 * @package Eloom_Yapay_Domains
 */
class Eloom_Yapay_Domains_Transaction {

	private $availablePaymentMethods;

	private $customerIp;

	private $shippingType;

	private $shippingPrice;

	private $priceDiscount;

	private $urlNotification;

	private $free;

	private $orderNumber;

	/**
	 * @return mixed
	 */
	public function getAvailablePaymentMethods() {
		return $this->availablePaymentMethods;
	}

	/**
	 * @param mixed $availablePaymentMethods
	 */
	public function setAvailablePaymentMethods($availablePaymentMethods) {
		$this->availablePaymentMethods = $availablePaymentMethods;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCustomerIp() {
		return $this->customerIp;
	}

	/**
	 * @param mixed $customerIp
	 */
	public function setCustomerIp($customerIp) {
		$this->customerIp = $customerIp;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getShippingType() {
		return $this->shippingType;
	}

	/**
	 * @param mixed $shippingType
	 */
	public function setShippingType($shippingType) {
		$this->shippingType = $shippingType;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getShippingPrice() {
		return $this->shippingPrice;
	}

	/**
	 * @param mixed $shippingPrice
	 */
	public function setShippingPrice($shippingPrice) {
		$this->shippingPrice = $shippingPrice;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPriceDiscount() {
		return $this->priceDiscount;
	}

	/**
	 * @param mixed $priceDiscount
	 */
	public function setPriceDiscount($priceDiscount) {
		$this->priceDiscount = $priceDiscount;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUrlNotification() {
		return $this->urlNotification;
	}

	/**
	 * @param mixed $urlNotification
	 */
	public function setUrlNotification($urlNotification) {
		$this->urlNotification = $urlNotification;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFree() {
		return $this->free;
	}

	/**
	 * @param mixed $free
	 */
	public function setFree($free) {
		$this->free = $free;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getOrderNumber() {
		return $this->orderNumber;
	}

	/**
	 * @param mixed $orderNumber
	 */
	public function setOrderNumber($orderNumber) {
		$this->orderNumber = $orderNumber;
		return $this;
	}

}