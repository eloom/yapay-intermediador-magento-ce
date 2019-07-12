<?php

class Eloom_Yapay_Resources_Responsibility_Configuration_Wrapper implements Eloom_Yapay_Resources_Responsibility_Handler {
	private $successor;

	public function successor($next) {
		$this->successor = $next;
		return $this;
	}

	public function handler($action, $class) {
		if (class_exists('ConfigWrapper')) {
			$configWrapper = new \ConfigWrapper;
			return array_merge(
				Eloom_Yapay_Helpers_Wrapper::environment($configWrapper),
				Eloom_Yapay_Helpers_Wrapper::credentials($configWrapper),
				Eloom_Yapay_Helpers_Wrapper::charset($configWrapper)
			);
		}
		return $this->successor->handler($action, $class);
	}
}
