<?php

/**
 * Class Shipping
 * @package Yapay\Resources\Factory\Request
 */
class Eloom_Yapay_Resources_Factory_Item {

	/**
	 * @var array
	 */
	private $item;

	/**
	 * Item constructor.
	 */
	public function __construct() {
		$this->item = array();
	}

	/**
	 * @param \Yapay\Domains\Item $item
	 * @return \Yapay\Domains\Item
	 */
	public function instance(Eloom_Yapay_Domains_Item $item) {
		return $item;
	}

	/**
	 * @param $description
	 * @param $quantity
	 * @param $priceUnit
	 * @param $code
	 * @param $skuCode
	 * @param null $extra
	 * @return array
	 */
	public function withParameters($description, $quantity, $priceUnit, $code, $skuCode, $extra = null) {
		$item = new Eloom_Yapay_Domains_Item();
		$item->setDescription($description);
		$item->setQuantity($quantity);
		$item->setPriceUnit($priceUnit);
		$item->setCode($code);
		$item->setSkuCode($skuCode);
		$item->setExtra($extra);

		array_push($this->item, $item);

		return $this->item;
	}

}
