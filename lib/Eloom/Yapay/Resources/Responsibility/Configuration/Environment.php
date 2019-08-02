<?php

class Eloom_Yapay_Resources_Responsibility_Configuration_Environment implements Eloom_Yapay_Resources_Responsibility_Handler {
	private $successor;

	/**
	 * @inheritDoc
	 */
	public function successor($next) {
		$this->successor = $next;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function handler($action, $class) {
		if (file_exists(YP_CONFIG)) {
			return array_merge(
				$this->credentials(),
				$this->charset(),
				$this->environment()
			);
		}
		return $this->successor->handler($action, $class);
	}

	private function credentials() {
		$xml = simplexml_load_file(YP_CONFIG);
		return [
			'credentials' => [
				'accountToken' => [
					'environment' => [
						'production' => Mage::helper('eloom_yapay/config')->getToken(),
						'sandbox' => Mage::helper('eloom_yapay/config')->getToken()
					]
				],
				'resellerToken' => [
					'environment' => [
						'production' => current($xml->account->production->resellerToken),
						'sandbox' => current($xml->account->sandbox->resellerToken)
					]
				],
				'consumerKey' => [
					'environment' => [
						'production' => current($xml->application->production->consumerKey),
						'sandbox' => current($xml->application->sandbox->consumerKey)
					]
				],
				'consumerSecret' => [
					'environment' => [
						'production' => current($xml->application->production->consumerSecret),
						'sandbox' => current($xml->application->sandbox->consumerSecret)
					]
				]
			]
		];
	}

	private function charset() {
		return [
			'charset' => current(
				simplexml_load_file(YP_CONFIG)->charset
			)
		];
	}

	private function environment() {
		return [
			'environment' => Mage::helper('eloom_yapay/config')->getEnvironment()
		];
	}
}
