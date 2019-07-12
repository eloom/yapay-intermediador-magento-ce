<?php

trait Eloom_Yapay_Domains_Requests_Split {

	/**
	 * @var
	 */
	private $split;

	/**
	 * @return Adapter\Split
	 */
	public function setSplit() {
		$this->split = Eloom_Yapay_Helpers_InitializeObject::initialize($this->split, 'Eloom_Yapay_Domains_Split');
		return new Eloom_Yapay_Domains_Requests_Adapter_Split($this->split);
	}

	/**
	 * @return mixed
	 */
	public function getSplit() {
		return $this->split;
	}

}
