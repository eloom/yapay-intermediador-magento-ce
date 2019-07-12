<?php

class Eloom_Yapay_Resources_Responsibility_Configuration_File implements Eloom_Yapay_Resources_Responsibility_Handler {
	private $successor;

	public function successor($next) {
		$this->successor = $next;
		return $this;
	}

	public function handler($action, $class) {
		if (file_exists(PS_CONFIG_PATH . "Wrapper.php")) {
			$wrapper = new Wrapper;
			return array_merge(
				Eloom_Yapay_Helpers_Wrapper::environment($wrapper),
				Eloom_Yapay_Helpers_Wrapper::credentials($wrapper),
				Eloom_Yapay_Helpers_Wrapper::charset($wrapper)
			);
		}
		return $this->successor->handler($action, $class);
	}
}
