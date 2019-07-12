<?php

trait Eloom_Yapay_Domains_Requests_Item {

	private $items;

	public function addItems() {
		$this->items = Eloom_Yapay_Helpers_InitializeObject::Initialize(
			$this->items, new Eloom_Yapay_Resources_Factory_Item()
		);

		return $this->items;
	}

	public function setItems($items) {
		if (is_array($items)) {
			$arr = array();
			foreach ($items as $key => $item) {
				if ($item instanceof Eloom_Yapay_Domains_Item) {
					$arr[$key] = $item;
				} else {
					if (is_array($item)) {
						$arr[$key] = new Eloom_Yapay_Domains_Item($item);
					}
				}
			}
			$this->items = $arr;
		}
	}

	public function getItems() {
		return current($this->items);
	}

	public function itemLenght() {
		return count(current($this->items));
	}

}
