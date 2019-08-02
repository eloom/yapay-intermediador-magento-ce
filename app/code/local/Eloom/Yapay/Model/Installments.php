<?php

##eloom.licenca##

class Eloom_Yapay_Model_Installments extends Mage_Core_Model_Abstract {

	/**
	 * @param $paymentMethodId
	 * @param $amount
	 * @return array
	 * @throws Exception
	 */
	public function calculateInstallmentsByAntecipacao($paymentMethodId, $amount) {
		$token = Eloom_Yapay_Configuration_Configure::getAccountCredentials()->getToken();
		$params = array('token_account' => $token, 'price' => $amount);

		$url = Eloom_Yapay_Resources_Builder::getWebserviceUrl() . '/v1/transactions/simulate_splitting';
		$http = new Eloom_Yapay_Resources_Http ();
		$http->post($url, $params);
		$response = Eloom_Yapay_Resources_Responsibility::http($http, new Eloom_Yapay_Parsers_Installment_Request());

		$installments = [];

		foreach ($response->data_response->payment_methods->payment_method as $paymentMethod) {
			if (strtolower($paymentMethod->payment_method_id) == $paymentMethodId) {
				foreach ($paymentMethod->splittings->splitting as $installment) {
					$installments[] = array('Split' => $installment->split->__toString(),
						'SplitValue' => floatval($installment->value_split->__toString()),
						'TransactionValue' => floatval($installment->value_transaction->__toString()),
						'AdditionRetention' => $installment->addition_retention->__toString(),
						'SplitRate' => floatval($installment->split_rate->__toString())
					);
				}

				break;
			}
		}

		return $installments;
	}

	/**
	 * @param $amount
	 * @return array
	 */
	public function calculateInstallmentsByFluxo($amount) {
		$config = Mage::helper('eloom_yapay/config');

		$interest = str_replace(',', '.', $config->getPaymentCcInterest());
		$interest = floatval($interest);

		$totalInstallments = $config->getPaymentCcTotalInstallments();
		$installmentsWithoutInterest = $config->getPaymentCcInstallmentsWithoutInterest();
		$totalAmount = 0;
		$j = 1;

		$installments = [];
		$store = Mage::getSingleton('checkout/session')->getQuote()->getStore();

		while ($j <= $totalInstallments) {
			$paymentMode = null;
			$installmentAmount = 0;

			if ($j <= $installmentsWithoutInterest) {
				$installmentAmount = $amount / $j;
			} else {
				$installmentAmount = Mage::helper('eloom_yapay/math')->calculatePayment($amount, $interest / 100, $j);
			}
			$totalAmount = $store->roundPrice($installmentAmount * $j);

			$installments[] = array('Split' => strval($j),
				'SplitValue' => floatval($installmentAmount),
				'TransactionValue' => floatval($totalAmount),
				'AdditionRetention' => '0',
				'SplitRate' => floatval(($j <= $installmentsWithoutInterest ? 0 : $interest))
			);

			$j++;
		}

		return $installments;
	}
}
