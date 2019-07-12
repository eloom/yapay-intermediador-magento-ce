<?php

namespace Yapay\Parsers\DirectPayment\OnlineDebit;

/**
 * Request from the Online debit direct payment
 * @package Yapay\Parsers\DirectPayment\OnlineDebit
 */

use Yapay\Enum\Properties\BackwardCompatibility;
use Yapay\Enum\Properties\Current;
use Yapay\Parsers\Basic;
use Yapay\Parsers\Currency;
use Yapay\Parsers\DirectPayment\Mode;
use Yapay\Parsers\Error;
use Yapay\Parsers\Item;
use Yapay\Parsers\Parser;
use Yapay\Parsers\ReceiverEmail;
use Yapay\Parsers\Customer;
use Yapay\Parsers\Shipping;
use Yapay\Parsers\Split;
use Yapay\Resources\Http;
use Yapay\Parsers\Transaction\OnlineDebit\Response;

/**
 * Class Payment
 * @package Yapay\Parsers\DirectPayment\OnlineDebit
 */
class Request extends Error implements Parser {
	use BankName;
	use Basic;
	use Currency;
	use Item;
	use Method;
	use Mode;
	use ReceiverEmail;
	use Customer;
	use Shipping;

	/**
	 * @param \Yapay\Domains\Requests\DirectPayment\OnlineDebit $onlineDebit
	 * @return array
	 */
	public static function getData(\Yapay\Domains\Requests\DirectPayment\OnlineDebit $onlineDebit) {
		$data = [];
		$properties = new BackwardCompatibility();
		return array_merge(
			$data,
			BankName::getData($onlineDebit, $properties),
			Basic::getData($onlineDebit, $properties),
			Currency::getData($onlineDebit, $properties),
			Item::getData($onlineDebit, $properties),
			Method::getData($properties),
			Mode::getData($onlineDebit, $properties),
			ReceiverEmail::getData($onlineDebit, $properties),
			Customer::getData($onlineDebit, $properties),
			Shipping::getData($onlineDebit, $properties),
			Split::getData($onlineDebit, $properties)
		);
	}

	/**
	 * @param \Yapay\Resources\Http $http
	 * @return Response
	 */
	public static function success(Http $http) {
		$xml = simplexml_load_string($http->getResponse());

		return (new Response)->setDate(current($xml->date))
			->setCode(current($xml->code))
			->setReference(current($xml->reference))
			->setRecoveryCode(current($xml->recoveryCode))
			->setType(current($xml->type))
			->setStatus(current($xml->status))
			->setLastEventDate(current($xml->lastEventDate))
			->setCancelationSource(current($xml->cancelationSource))
			->setPaymentLink(current($xml->paymentLink))
			->setPaymentMethod($xml->paymentMethod)
			->setGrossAmount(current($xml->grossAmount))
			->setDiscountAmount(current($xml->discountAmount))
			->setFeeAmount(current($xml->feeAmount))
			->setNetAmount(current($xml->netAmount))
			->setExtraAmount(current($xml->extraAmount))
			->setEscrowEndDate(current($xml->escrowEndDate))
			->setInstallmentCount(current($xml->installmentCount))
			->setItemCount(current($xml->itemCount))
			->setItems($xml->items)
			->setCustomer($xml->sender)
			->setCreditorFees($xml->creditorFees)
			->setApplication($xml->applications)
			->setShipping($xml->shipping);
	}

	/**
	 * @param \Yapay\Resources\Http $http
	 * @return \Yapay\Domains\Error
	 */
	public static function error(Http $http) {
		return parent::error($http);
	}
}
