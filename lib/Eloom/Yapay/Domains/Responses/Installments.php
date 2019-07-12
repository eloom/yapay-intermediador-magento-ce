<?php

/**
 * Domain class for Installments
 */
class Eloom_Yapay_Domains_Responses_Installments {
	/**
	 *
	 * @var
	 */
	private $installments;

	/**
	 * @return array
	 */
	public function getInstallments() {
		return $this->installments;
	}

	/**
	 * @param Yapay\Domains\Responses\Installment $installments
	 */
	public function setInstallments($installments) {
		if ($installments) {
			foreach ($installments as $installment) {
				$this->addInstallment($installment);
			}
		}
	}

	/**
	 * @param Yapay\Domains\Responses\Installment $installment
	 */
	private function addInstallment($installment) {
		$response = new Eloom_Yapay_Domains_Responses_Installment();
		$response->setSplit($installment['split']);
		$response->setSplitValue($installment['value_split']);
		$response->setSplitRate($installment['value_transaction']);
		$response->setAdditionRetention($installment['addition_retention']);
		$response->setTransactionValue($installment['split_rate']);

		$this->installments[] = $response;
	}
}
