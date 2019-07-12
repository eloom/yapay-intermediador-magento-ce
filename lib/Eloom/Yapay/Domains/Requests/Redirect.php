<?php

trait Eloom_Yapay_Domains_Requests_Redirect {

	private $rUrl;

	public function getUrl() {
		return $this->rUrl;
	}

	public function setUrl($url) {
		$this->rUrl = $url;
	}

}
