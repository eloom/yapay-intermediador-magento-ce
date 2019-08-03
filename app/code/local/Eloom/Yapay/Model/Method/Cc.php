<?php

##eloom.licenca##

class Eloom_Yapay_Model_Method_Cc extends Mage_Payment_Model_Method_Abstract {

	const PAYMENT_METHOD_CC_CODE = 'eloom_yapay_cc';

	protected $_formBlockType = 'eloom_yapay/payment_cc_form';
	protected $_infoBlockType = 'eloom_yapay/payment_cc_info';

	/**
	 *
	 */
	protected $_code = self::PAYMENT_METHOD_CC_CODE;

	/**
	 * Payment Method features
	 * @var bool
	 */
	protected $_isGateway = false;
	protected $_canOrder = true;
	protected $_canAuthorize = true;
	protected $_canCapture = true;
	protected $_canCapturePartial = false;
	protected $_canCaptureOnce = false;
	protected $_canRefund = false;
	protected $_canRefundInvoicePartial = false;
	protected $_canVoid = true;
	protected $_canUseInternal = false;
	protected $_canUseCheckout = true;
	protected $_canUseForMultishipping = false;
	protected $_isInitializeNeeded = false;
	protected $_canFetchTransactionInfo = false;
	protected $_canReviewPayment = false;
	protected $_canCreateBillingAgreement = false;
	protected $_canManageRecurringProfiles = false;
	protected $_canCancelInvoice = false;
	protected $_canSaveCc = true;

	protected function _construct() {
		parent::_construct();
	}

	public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('eloomyapay/cc/payment', array('_secure' => true));
	}


	/**
	 * Get instructions text from config
	 *
	 * @return string
	 */
	public function getInstructions() {
		return trim($this->getConfigData('instructions'));
	}

	/**
	 * Prepare info instance for save
	 *
	 * @return Mage_Payment_Model_Abstract
	 */
	public function prepareSave() {
		$info = $this->getInfoInstance();

		if ($info->getCcCvc() && $info->getCcCvc() != '') {
			$additional = new stdClass();
			$additional->creditCardNumber = $info->getCcNumber();
			$additional->creditCardHolderName = $info->getCcOwner();
			$additional->creditCardCvc = $info->getCcCvc();
			$additional->creditCardExpiry = $info->getCcExpiry();
			$additional->fingerPrint = $info->getFingerPrint();

			$installments = 0;
			$installmentAmount = 0;

			$arrayex = explode('-', $info->getCcInstallments());
			if (isset($arrayex[0])) {
				$installments = $arrayex[0];
				$installmentAmount = $arrayex[1];
			}

			$additional->installments = $installments;
			$additional->installmentAmount = $installmentAmount;

			if ($info->getCcHolderAnother() && $info->getCcHolderAnother() == 1) {
				$additional->creditCardHolderAnother = $info->getCcHolderAnother();
				$additional->creditCardHolderCpf = $info->getCcHolderCpf();
				$additional->creditCardHolderPhone = $info->getCcHolderPhone();
				$additional->creditCardHolderBirthDate = $info->getCcHolderBirthDate();
			}

			$serializedValue = json_encode($additional);
			$info->setAdditionalData($serializedValue);
		}

		return $this;
	}

	/**
	 * Assign data to info model instance
	 *
	 * @param mixed $data
	 * @return  Mage_Payment_Model_Info
	 */
	public function assignData($data) {
		if (!($data instanceof Varien_Object)) {
			$data = new Varien_Object($data);
		}

		if ($data->getYapayCcNumber() && $data->getYapayCcType() && $data->getYapayCcExpiry() && $data->getYapayCcCvc()) {
			$ccNumber = preg_replace('/\D/', '', $data->getYapayCcNumber());

			$info = $this->getInfoInstance();
			$info->setCcOwner($data->getYapayCcOwner())
				->setCcLast4(substr($ccNumber, -4))
				->setCcType($data->getYapayCcType())
				->setCcCvc($info->encrypt($data->getYapayCcCvc()))
				->setCcInstallments($data->getYapayCcInstallments())
				->setCcNumber($info->encrypt($ccNumber))
				->setFingerPrint($data->getYapayCcFingerPrint());

			if ($data->getYapayCcExpiry() && $data->getYapayCcExpiry() != '') {
				$expiry = explode("/", trim($data->getYapayCcExpiry()));
				$month = trim($expiry[0]);
				$year = trim($expiry[1]);
				if (strlen($year) == 2) {
					$year = '20' . $year;
				}
				$expiry = $year . '/' . $month;
				$info->setCcExpiry($expiry);
			}

			if ($data->getYapayCcHolderAnother() && $data->getYapayCcHolderAnother() == 1) {
				$info->setCcHolderAnother($data->getYapayCcHolderAnother())
					->setCcHolderCpf($data->getYapayCcHolderCpf())
					->setCcHolderPhone($data->getYapayCcHolderPhone())
					->setCcHolderBirthDate($data->getYapayCcHolderBirthDate());
			} else {
				$info->setCcHolderAnother(0);
			}

			$info->getQuote()->save();
		}

		return $this;
	}

	public function validate() {
		parent::validate();

		/*
		 * Descomentar essa linha para forçar erros
		 */
		//return $this;

		$info = $this->getInfoInstance();
		$additionalData = json_decode($info->getAdditionalData());

		if ($additionalData) {
			$ccNumber = $info->decrypt($additionalData->creditCardNumber);
			$cvcNumber = $info->decrypt($additionalData->creditCardCvc);

			$date = new Eloom_LVR_CardExpirationDate();
			$card = new Eloom_LVR_CardCvc($ccNumber);

			if (!$card->passes($cvcNumber)) {
				Mage::throwException($card->message());
			}
			if (!$date->passes(trim($additionalData->creditCardExpiry))) {
				Mage::throwException($date->message());
			}
		}

		return $this;
	}

}
