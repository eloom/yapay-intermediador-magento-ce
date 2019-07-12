<?php

/**
 * Class Document
 * @package Yapay\Resources\Factory
 */
class Eloom_Yapay_Resources_Factory_Customer_Document {

	/**
	 * @var \Yapay\Domains\Document
	 */
	private $customer;

	/**
	 * Document constructor.
	 */
	public function __construct($customer) {
		$this->customer = $customer;
	}

	/**
	 * @param \Yapay\Domains\Document $document
	 * @return \Yapay\Domains\Document
	 */
	public function instance(Eloom_Yapay_Domains_Document $document) {
		$this->customer->setDocuments($document);
		return $this->customer;
	}

	/**
	 * @param $array
	 * @return \Yapay\Domains\Document|Document
	 */
	public function withArray($array) {
		$properties = new Eloom_Yapay_Enum_Properties_Current();
		$document = new Eloom_Yapay_Domains_Document();
		$document->setType($array[$properties::DOCUMENT_TYPE])
			->setIdentifier($array[$properties::DOCUMENT_VALUE]);
		$this->customer->setDocuments($document);
		return $this->customer;
	}

	/**
	 * @param $type
	 * @param $identifier
	 * @return \Yapay\Domains\Document
	 */
	public function withParameters($type, $identifier) {
		$document = new Eloom_Yapay_Domains_Document();
		$document->setType($type)
			->setIdentifier($identifier);
		$this->customer->setDocuments($document);
		return $this->customer;
	}

}
