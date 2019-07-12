<?php

/**
 * Class Basic
 * @package Yapay\Parsers
 */
trait Eloom_Yapay_Parsers_Split {

	/**
	 * @param Requests $request
	 * @param $properties
	 * @return array
	 */
	public static function getData(Eloom_Yapay_Domains_Requests_Requests $request, $properties) {
		$data = [];
		if (!is_null($request->getSplit())) {
			if (!is_null($request->getSplit()->getPrimaryReceiver())) {
				$data[$properties::PRIMARY_RECEIVER_PUBLIC_KEY] = $request->getSplit()->getPrimaryReceiver();
			}
			if (count($request->getSplit()->getReceivers()) > 0) {
				$receivers = $request->getSplit()->getReceivers();
				$count = 0;
				foreach ($receivers as $key => $value) {
					$count++;
					if (!is_null($receivers[$key]->getPublicKey())) {
						$data[sprintf($properties::RECEIVER_PUBLIC_KEY, $count)] = $receivers[$key]->getPublicKey();
					}
					if (!is_null($receivers[$key]->getAmount())) {
						$data[sprintf($properties::RECEIVER_SPLIT_AMOUNT, $count)] = Eloom_Yapay_Helpers_Currency::toDecimal($receivers[$key]->getAmount());
					}
					if (!is_null($receivers[$key]->getRatePercent())) {
						$data[sprintf($properties::RECEIVER_SPLIT_RATE_PERCENT, $count)] = Eloom_Yapay_Helpers_Currency::toDecimal($receivers[$key]->getRatePercent());
					}
					if (!is_null($receivers[$key]->getFeePercent())) {
						$data[sprintf($properties::RECEIVER_SPLIT_FEE_PERCENT, $count)] = Eloom_Yapay_Helpers_Currency::toDecimal($receivers[$key]->getFeePercent());
					}
				}
			}
		}
		return $data;
	}

}
