<?php

##eloom.licenca##

class Eloom_Yapay_Block_Checkout_Onepage_Details extends Mage_Core_Block_Template {

  protected $additionalData;

  protected function _construct() {
    parent::_construct();
    if(!$this->isBoleto() && !$this->isCc()) {
      return;
    }
    $this->setTemplate('eloom/yapay/checkout/onepage/success-details.phtml');
    $info = $this->getPayment();
    $this->additionalData = json_decode($info->getAdditionalData());
  }

  public function isBoleto() {
    $method = $this->getPayment()->getMethodInstance()->getCode();
    if ($method == Eloom_Yapay_Model_Method_Boleto::PAYMENT_METHOD_BOLETO_CODE) {
      return true;
    }

    return false;
  }

  public function getBilletLink() {
    if (isset($this->additionalData->paymentLink)) {
      return $this->additionalData->paymentLink;
    }

    return null;
  }

  public function getBilletDateOfExpiration() {
    if (isset($this->additionalData->dateOfExpiration)) {
      return $this->additionalData->dateOfExpiration;
    }

    return null;
  }

  public function isCc() {
    $method = $this->getPayment()->getMethodInstance()->getCode();
    if ($method == Eloom_Yapay_Model_Method_Cc::PAYMENT_METHOD_CC_CODE) {
      return true;
    }

    return false;
  }

  public function getYapayOrderId() {
    if (isset($this->additionalData->yapayOrderId)) {
      return $this->additionalData->yapayOrderId;
    }
    return null;
  }

  public function getBilletBarcode() {
    if (isset($this->additionalData->barCode)) {
      return $this->additionalData->barCode;
    }

    return null;
  }

  public function getPayment() {
    return Mage::helper('eloom_yapay')->getPayment();
  }

}
