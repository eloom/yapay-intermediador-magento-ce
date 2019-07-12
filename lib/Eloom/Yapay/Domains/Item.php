<?php

/**
 * Class Item
 * @package Yapay\Domains
 */
class Eloom_Yapay_Domains_Item {

	private $description;

	private $quantity;

	private $priceUnit;

	private $code;

	private $skuCode;

	private $extra;

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * @param mixed $quantity
	 */
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPriceUnit() {
		return $this->priceUnit;
	}

	/**
	 * @param mixed $priceUnit
	 */
	public function setPriceUnit($priceUnit) {
		$this->priceUnit = $priceUnit;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @param mixed $code
	 */
	public function setCode($code) {
		$this->code = $code;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSkuCode() {
		return $this->skuCode;
	}

	/**
	 * @param mixed $skuCode
	 */
	public function setSkuCode($skuCode) {
		$this->skuCode = $skuCode;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getExtra() {
		return $this->extra;
	}

	/**
	 * @param mixed $extra
	 */
	public function setExtra($extra) {
		$this->extra = $extra;
		return $this;
	}
}
