<?php

/**
 * Class Item
 * @package Yapay\Parsers
 */
trait Eloom_Yapay_Parsers_TransactionProduct {

	/**
	 * @param Requests $request
	 * @param $properties
	 * @return array
	 */
	public static function getData(Eloom_Yapay_Domains_Requests_Requests $request, $properties) {
		$data = [];
		$items = $request->getItems();

		if ($request->itemLenght() > 0) {
			$count = 0;

			foreach ($items as $key => $value) {
				$count++;
				if ($items[$key]->getDescription() != null) {
					$data[$count][$properties::ITEM_DESCRIPTION] = $items[$key]->getDescription();
				}
				if ($items[$key]->getQuantity() != null) {
					$data[$count][$properties::ITEM_QUANTITY] = $items[$key]->getQuantity();
				}
				if ($items[$key]->getSkuCode() != null) {
					$data[$count][$properties::ITEM_SKU_CODE] = $items[$key]->getSkuCode();
				}
				if ($items[$key]->getCode() != null) {
					$data[$count][$properties::ITEM_CODE] = $items[$key]->getCode();
				}
				if ($items[$key]->getPriceUnit() != null) {
					$amount = Eloom_Yapay_Helpers_Currency::toDecimal($items[$key]->getPriceUnit());
					$data[$count][$properties::ITEM_AMOUNT] = $amount;
				}
			}
		}

		return array('transaction_product' => $data);
	}

}
