<?php


/**
 * Class BackwardCompatibility
 * @package Yapay\Enum\Properties
 */
class Eloom_Yapay_Enum_Properties_BackwardCompatibility {

	/**
	 *  Application ID
	 */
	const APP_ID = "appId";

	/**
	 *  Application Key
	 */
	const APP_KEY = "appKey";

	const TOKEN = 'token_account';

	const RESELLER_TOKEN = 'reseller_token';

	const FINGER_PRINT = 'finger_print';

	/**
	 * Address type
	 */
	const ADDRESS_TYPE = "type_address";

	/**
	 * Address street
	 */
	const ADDRESS_STREET = "street";

	/**
	 * Address number
	 */
	const ADDRESS_NUMBER = "number";

	/**
	 * Address complement
	 */
	const ADDRESS_COMPLEMENT = "completion";

	/**
	 *  Address city
	 */
	const ADDRESS_CITY = "city";

	/**
	 *  Address state
	 */
	const ADDRESS_STATE = "state";

	/**
	 *  Address district
	 */
	const ADDRESS_DISTRICT = "neighborhood";

	/**
	 * Address postal code
	 */
	const ADDRESS_POSTAL_CODE = "postal_code";

	/**
	 * Address postal code
	 */
	const ADDRESS_COUNTRY = "country";


	/**
	 *  Currency
	 */
	const CURRENCY = "currency";

	/**
	 *  Extra amount
	 */
	const CURRENCY_EXTRA_AMOUNT = "extraAmount";

	/**
	 * Credit card holder name for credit card direct payment
	 */
	const CREDIT_CARD_HOLDER_NAME = 'card_name';

	/**
	 * Credit card holder birth date for credit card direct payment
	 */
	const CREDIT_CARD_NUMBER = 'card_number';

	/**
	 * Credit card holder cpf for credit card direct payment
	 */
	const CREDIT_CARD_EXPDATE_MONTH = 'card_expdate_month';

	/**
	 * Credit card holder area code for credit card direct payment
	 */
	const CREDIT_CARD_EXPDATE_YEAR = 'card_expdate_year';

	/**
	 * Credit card holder phone for credit card direct payment
	 */
	const CREDIT_CARD_CVV = 'card_cvv';

	const SPLIT = 'split';

	/**
	 *  Payment mode
	 */
	const DIRECT_PAYMENT_MODE = "payment.mode";

	/**
	 *  Payment method
	 */
	const AVAILABLE_PAYMENT_METHOD = "available_payment_methods";

	const PAYMENT_METHOD_ID = 'payment_method_id';

	/**
	 * Installment quantity for credit card payment
	 */
	const INSTALLMENT_QUANTITY = "installment.quantity";

	/**
	 * Installment value for credit card payment
	 */
	const INSTALLMENT_VALUE = "installment.value";

	/**
	 * Installment no interest installment quantity for credit card payment
	 */
	const INSTALLMENT_NO_INTEREST_INSTALLMENT_QUANTITY = "installment.noInterestInstallmentQuantity=";

	/**
	 *  Item id
	 */
	const ITEM_CODE = "code";

	/**
	 *  Item description
	 */
	const ITEM_DESCRIPTION = "description";

	/**
	 *  Item amount
	 */
	const ITEM_AMOUNT = "price_unit";

	/**
	 *  Item quantity
	 */
	const ITEM_QUANTITY = "quantity";

	/**
	 * Item sku_code
	 */
	const ITEM_SKU_CODE = "sku_code";

	/**
	 * Item extra
	 */
	const ITEM_EXTRA = "extra";

	/**
	 *  Notification URL
	 */
	const NOTIFICATION_URL = "url_notification";

	/**
	 *  Bank name
	 */
	const ONLINE_DEBIT_BANK_NAME = "bank.name";

	/**
	 * Receiver email
	 */
	const RECEIVER_EMAIL = 'receiver.email';

	/**
	 *  Receiver public key
	 */
	const RECEIVER_PUBLIC_KEY = "receiver[%s].publicKey";

	/**
	 *  Receiver split amount
	 */
	const RECEIVER_SPLIT_AMOUNT = "receiver[%s].split.amount";

	/**
	 *  Receiver split rate percent
	 */
	const RECEIVER_SPLIT_RATE_PERCENT = "receiver[%s].split.ratePercent";

	/**
	 *  Receiver split fee percent
	 */
	const RECEIVER_SPLIT_FEE_PERCENT = "receiver[%s].split.feePercent";

	/**
	 * Redirect Url
	 */
	const REDIRECT_URL = "redirectURL";

	/**
	 *  Reference
	 */
	const REFERENCE = "reference";

	/**
	 * Customer name
	 */
	const CUSTOMER_NAME = "name";

	/**
	 * Customer email
	 */
	const CUSTOMER_EMAIL = "email";

	/**
	 * Customer email
	 */
	const CUSTOMER_BIRTH_DATE = "birth_date";

	/**
	 * Customer hash
	 */
	const SENDER_HASH = "sender.hash";

	/**
	 * Customer ip number
	 */
	const SENDER_IP = "sender.ip";

	/**
	 *  Customer area code
	 */
	const SENDER_PHONE_AREA_CODE = "sender.areaCode";

	/**
	 * Customer phone number
	 */
	const SENDER_PHONE_NUMBER = "sender.phone";

	/**
	 *  Customer CPF
	 */
	const DOCUMENT_CPF = "cpf";

	/**
	 * Customer CNPJ
	 */
	const DOCUMENT_CNPJ = "cnpj";

	/**
	 * Shipping type
	 */
	const SHIPPING_TYPE = "shipping_type";

	/**
	 * Shipping cost
	 */
	const SHIPPING_PRICE = "shipping_price";

	/**
	 *  Primary Key
	 */
	const PRIMARY_RECEIVER_PUBLIC_KEY = "primaryReceiver.publicKey";

	const CUSTOMER_IP = 'customer_ip';

	const PRICE_DISCOUNT = 'price_discount';

	const FREE = 'free';

	const ORDER_NUMBER = 'order_number';
}
