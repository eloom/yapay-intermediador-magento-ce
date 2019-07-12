<?php

trait Eloom_Yapay_Domains_Requests_Metadata {

	private $metadata;

	public function addMetadata() {
		$this->metadata = Eloom_Yapay_Helpers_InitializeObject::Initialize(
			$this->metadata, new Eloom_Yapay_Resources_Factory_Request_Metadata()
		);

		return $this->metadata;
	}

	public function setMetadata($metadata) {
		if (is_array($metadata)) {
			$arr = array();
			foreach ($metadata as $key => $metadataItem) {
				if ($metadataItem instanceof Eloom_Yapay_Domains_Metadata) {
					$arr[$key] = $metadataItem;
				} else {
					if (is_array($metadata)) {
						$arr[$key] = new Eloom_Yapay_Domains_Metadata($metadataItem);
					}
				}
			}
			$this->metadata = $arr;
		}
	}

	public function getMetadata() {
		return current($this->metadata);
	}

	public function metadataLenght() {
		return (!is_null($this->metadata)) ? count(current($this->metadata)) : 0;
	}

}
