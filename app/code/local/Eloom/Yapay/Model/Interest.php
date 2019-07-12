<?php

##eloom.licenca##

class Eloom_Yapay_Model_Interest extends Mage_Core_Model_Abstract {

  public function canApply($address) {
    $data = Mage::app()->getRequest()->getPost('payment', array());
    if (!count($data) || !isset($data['yapay_cc_installments'])) {
      return false;
    }

    $currentPaymentMethod = null;

    $sessionQuote = Mage::getSingleton('checkout/session')->getQuote();
    if ($sessionQuote->getPayment() != null && $sessionQuote->getPayment()->hasMethodInstance()) {
      $currentPaymentMethod = $sessionQuote->getPayment()->getMethodInstance()->getCode();
    } elseif (isset($data['method'])) {
      $currentPaymentMethod = $data['method'];
    }

    if ($currentPaymentMethod == Eloom_Yapay_Model_Method_Cc::PAYMENT_METHOD_CC_CODE) {
			$arrayex = explode('-', $data['yapay_cc_installments']);
			$installments = $arrayex[0];

			$config = Mage::helper('eloom_yapay/config');
    	if ($installments != null && $installments > $config->getPaymentCcInstallmentsWithoutInterest()) {
				return true;
			}
    }

    return false;
  }

  public function getInterest() {
		$data = Mage::app()->getRequest()->getPost('payment', array());
		$installments = 1;
		$arrayex = explode('-', $data['yapay_cc_installments']);
		if (isset($arrayex[0])) {
			$installments = $arrayex[0];
		}
		$interest = str_replace(',', '.', Mage::helper('eloom_yapay/config')->getPaymentCcInterest());

    $baseCurrencyCode = Mage::app()->getStore()->getBaseCurrencyCode();
		$baseSubtotalWithDiscount = 0;
    $baseTax = 0;

    $quote = Mage::getSingleton('checkout/session')->getQuote();
    if ($quote->isVirtual()) {
      $address = $quote->getBillingAddress();
    } else {
      $address = $quote->getShippingAddress();
    }
    if ($address) {
			$baseSubtotalWithDiscount = $address->getBaseSubtotalWithDiscount();
			$baseTax = $address->getBaseTaxAmount();
    }

    return Eloom_Yapay_Interest::getInstance($baseCurrencyCode, $interest, $baseSubtotalWithDiscount, $baseTax, $installments);
  }

  public function getModuleInterest($order) {
    return $order->getYapayInterestAmount();
  }

  public function getModuleBaseInterest($order) {
    return $order->getYapayBaseInterestAmount();
  }

  public function getModuleInterestCode() {
    return 'eloom_yapay_interest';
  }

}
