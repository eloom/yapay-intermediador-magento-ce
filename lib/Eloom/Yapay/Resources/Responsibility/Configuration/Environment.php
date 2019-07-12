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
		if (getenv(\Yapay\Enum\Configuration\Environment::ENV) and
			getenv(\Yapay\Enum\Configuration\Environment::EMAIL)) {
			return array_merge(
				$this->environment(),
				$this->credentials(),
				$this->charset(),
				$this->log()
			);
		}
		return $this->successor->handler($action, $class);
	}

	private function environment() {
		return [
			'environment' => getenv(\Yapay\Enum\Configuration\Environment::ENV)
		];
	}

	private function credentials() {
		return [
			'credentials' => [
				'email' => getenv(\Yapay\Enum\Configuration\Environment::EMAIL),
				'token' => [
					'environment' => [
						'production' => getenv(\Yapay\Enum\Configuration\Environment::TOKEN_PRODUCTION),
						'sandbox' => getenv(\Yapay\Enum\Configuration\Environment::TOKEN_SANDBOX)
					]
				],
				'appId' => [
					'environment' => [
						'production' => getenv(\Yapay\Enum\Configuration\Environment::APP_ID_PRODUCTION),
						'sandbox' => getenv(\Yapay\Enum\Configuration\Environment::APP_ID_SANDBOX)
					]
				],
				'appKey' => [
					'environment' => [
						'production' => getenv(\Yapay\Enum\Configuration\Environment::APP_KEY_PRODUCTION),
						'sandbox' => getenv(\Yapay\Enum\Configuration\Environment::APP_KEY_SANDBOX)
					]
				]
			]
		];
	}

	private function charset() {
		return [
			'charset' => getenv(\Yapay\Enum\Configuration\Environment::CHARSET)
		];
	}
}
