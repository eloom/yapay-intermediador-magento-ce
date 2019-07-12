<?php

/**
 * Class Customer
 * @package Yapay\Parsers
 */
trait Eloom_Yapay_Parsers_Customer {

	/**
	 * @param Requests $request
	 * @param $properties
	 * @return array
	 */
	public static function getData(Eloom_Yapay_Domains_Requests_Requests $request, $properties) {
		$data = [];
		if (!is_null($request->getCustomer())) {
			$customer = $request->getCustomer();

			if (!is_null($customer->getName())) {
				$data[$properties::CUSTOMER_NAME] = $customer->getName();
			}
			if (!is_null($customer->getEmail())) {
				$data[$properties::CUSTOMER_EMAIL] = $customer->getEmail();
			}
			if (!is_null($customer->getBirthDate())) {
				$data[$properties::CUSTOMER_BIRTH_DATE] = $customer->getBirthDate();
			}
			// documents
			if (!is_null($customer->getDocuments())) {
				$data = array_merge($data, self::documents($request, $properties));
			}
		}

		// phone
		if (!is_null($customer->getPhone())) {
			$data = array_merge($data, self::phone($request));
		}

		/* Address */
		$address = [];
		if (!is_null($request->getBilling())) {
			$address[0] = self::address($request->getBilling()->getAddress(), $properties);
		}
		if (!is_null($request->setShipping())) {
			$address[1] = self::address($request->getShipping()->getAddress(), $properties);
		}
		$data['addresses'] = $address;

		return array('customer' => $data);
	}

	private static function phone($request) {
		$phone = $request->getCustomer()->getPhone();
		$phoneNumber = $phone->getAreaCode() . $phone->getNumber();

		$typeContact = 'H';
		if (preg_match('/^[0-9]{2}[5-9]{1}[0-9]{7,8}$/',$phoneNumber)) {
			$typeContact = 'M';
		} elseif (preg_match('/^[0-9]{2}[1-6]{1}[0-9]{7}$/',$phoneNumber)) {
			$typeContact = 'H';
		} elseif (preg_match('/^0800[0-9]{6,7}$|^0300[0-9]{6,7}$/',$phoneNumber)) {
			$typeContact = 'W';
		}

		$data = array('contacts' => array(array('type_contact' => $typeContact, 'number_contact' => $phoneNumber)));

		return $data;
	}

	private static function documents($payment, $properties) {
		$data = [];
		$documents = $payment->getCustomer()->getDocuments();

		if (is_array($documents) && count($documents) == 1) {
			foreach ($documents as $document) {
				if (!is_null($document)) {
					$document->getType() == "CPF" ?
						$data[$properties::DOCUMENT_CPF] = Eloom_Yapay_Helpers_Characters::hasSpecialChars($document->getIdentifier()) :
						$data[$properties::DOCUMENT_CNPJ] = Eloom_Yapay_Helpers_Characters::hasSpecialChars($document->getIdentifier());
				}
			}
		}

		return $data;
	}

	/**
	 * @param $request
	 * @param $properties
	 * @return array
	 */
	private static function address($request, $properties) {
		$data = [];

		$data[$properties::ADDRESS_TYPE] = $request->getType();
		if (!is_null($request->getStreet())) {
			$data[$properties::ADDRESS_STREET] = $request->getStreet();
		}
		if (!is_null($request->getNumber())) {
			$data[$properties::ADDRESS_NUMBER] = $request->getNumber();
		}
		if (!is_null($request->getComplement())) {
			$data[$properties::ADDRESS_COMPLEMENT] = $request->getComplement();
		}
		if (!is_null($request->getCity())) {
			$data[$properties::ADDRESS_CITY] = $request->getCity();
		}
		if (!is_null($request->getState())) {
			$data[$properties::ADDRESS_STATE] = $request->getState();
		}
		if (!is_null($request->getDistrict())) {
			$data[$properties::ADDRESS_DISTRICT] = $request->getDistrict();
		}
		if (!is_null($request->getPostalCode())) {
			$data[$properties::ADDRESS_POSTAL_CODE] = $request->getPostalCode();
		}

		return $data;
	}

}
