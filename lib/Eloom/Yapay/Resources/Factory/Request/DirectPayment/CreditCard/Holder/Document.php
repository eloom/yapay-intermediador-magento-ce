<?php

/**
 * Class Document
 * @package Yapay\Resources\Factory
 */
class Eloom_Yapay_Resources_Factory_Request_DirectPayment_CreditCard_Holder_Document {

	/**
	 * @var \Yapay\Domains\Document
	 */
	private $holder;

	/**
	 * Document constructor.
	 */
	public function __construct($holder) {
		$this->holder = $holder;
	}

	/**
	 * @param \Yapay\Domains\Document $document
	 * @return \Yapay\Domains\DirectPayment\CreditCard\Holder
	 */
	public function instance(Eloom_Yapay_Domains_Document $document) {
		$this->holder->setDocuments($document);
		return $this->holder;
	}

	/**
	 * @param $array
	 * @return \Yapay\Domains\DirectPayment\CreditCard\Holder
	 */
	public function withArray($array) {
		$properties = new Eloom_Yapay_Enum_Properties_Current();
		$document = new Eloom_Yapay_Domains_Document();
		$document->setType($array[$properties::DOCUMENT_TYPE])
			->setIdentifier($array[$properties::DOCUMENT_VALUE]);
		$this->holder->setDocuments($document);
		return $this->holder;
	}

	/**
	 * @param $type
	 * @param $identifier
	 * @return \Yapay\Domains\DirectPayment\CreditCard\Holder
	 */
	public function withParameters($type, $identifier) {
		$document = new Eloom_Yapay_Domains_Document();
		$document->setType($type)
			->setIdentifier($identifier);
		$this->holder->setDocuments($document);
		return $this->holder;
	}

}
