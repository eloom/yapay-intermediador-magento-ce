<?php

trait Eloom_Yapay_Domains_Requests_Notification {

	private $nUrl;

	public function getUrl() {
		return $this->nUrl;
	}

	public function setUrl($url) {
		$this->nUrl = $url;
	}

}
