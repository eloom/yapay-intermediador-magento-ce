<?php

##eloom.licenca##

class Eloom_Yapay_Model_Method_Boleto extends Mage_Payment_Model_Method_Abstract {

  const PAYMENT_METHOD_BOLETO_CODE = 'eloom_yapay_boleto';

  protected $_formBlockType = 'eloom_yapay/payment_boleto_form';
  protected $_infoBlockType = 'eloom_yapay/payment_boleto_info';

  /**
   *
   */
  protected $_code = self::PAYMENT_METHOD_BOLETO_CODE;

  /**
   * Payment Method features
   * @var bool
   */
  protected $_isGateway = false;
  protected $_canOrder = false;
  protected $_canAuthorize = false;
  protected $_canCapture = false;
  protected $_canCapturePartial = false;
  protected $_canCaptureOnce = false;
  protected $_canRefund = false;
  protected $_canRefundInvoicePartial = false;
  protected $_canVoid = false;
  protected $_canUseInternal = false;
  protected $_canUseCheckout = true;
  protected $_canUseForMultishipping = false;
  protected $_isInitializeNeeded = false;
  protected $_canFetchTransactionInfo = false;
  protected $_canReviewPayment = false;
  protected $_canCreateBillingAgreement = false;
  protected $_canManageRecurringProfiles = false;
  protected $_canCancelInvoice = false;

  protected function _construct() {
    parent::_construct();
  }

  public function getOrderPlaceRedirectUrl() {
    return Mage::getUrl('eloomyapay/boleto/payment', array('_secure' => true));
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

		if ($info->getMethod() == self::PAYMENT_METHOD_BOLETO_CODE) {
			$additional = new stdClass();
			$additional->fingerPrint = $info->getFingerPrint();
			$serializedValue = json_encode($additional);

			$info->setAdditionalData($serializedValue);
		}

		return $this;
	}

	/**
	 * Assign data to info model instance
	 *
	 * @param   mixed $data
	 * @return  Mage_Payment_Model_Info
	 */
	public function assignData($data) {
		if (!($data instanceof Varien_Object)) {
			$data = new Varien_Object($data);
		}

		$info = $this->getInfoInstance();
		$info->setFingerPrint($data->getYapayBoletoFingerPrint());

		return $this;
	}

}
