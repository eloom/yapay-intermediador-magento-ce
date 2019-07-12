<?php

##eloom.licenca##

class Eloom_Yapay_Model_Sales_Quote_Address_Total_Interest extends Mage_Sales_Model_Quote_Address_Total_Abstract {

  protected $_code = 'eloom_yapay_interest';

  public function collect(Mage_Sales_Model_Quote_Address $address) {
    parent::collect($address);

    $this->_setAmount(0);
    $this->_setBaseAmount(0);
    $address->setYapayInterestAmount(0);
    $address->setYapayBaseInterestAmount(0);

    $items = $this->_getAddressItems($address);
    if (!count($items)) {
      return $this;
    }

    $interest = Mage::getSingleton('eloom_yapay/interest');
    if ($interest->canApply($address)) {
      $paymentInterest = $interest->getInterest();
			$store = $address->getQuote()->getStore();

			$shippingAmount = $address->getShippingAmount();
      $amount = ($paymentInterest->baseSubtotalWithDiscount + $paymentInterest->baseTax + $shippingAmount);

      $installmentValue = Mage::helper('eloom_yapay/math')->calculatePayment($amount, $paymentInterest->getTotalPercent() / 100, $paymentInterest->getInstallment());
			$baseTotalInterestAmount = ($installmentValue * $paymentInterest->getInstallment()) - $amount;
			$baseTotalInterestAmount = $store->roundPrice($baseTotalInterestAmount);

      $totalInterestAmount = Mage::helper('directory')->currencyConvert($baseTotalInterestAmount, $paymentInterest->baseCurrencyCode);

			$address->setYapayInterestAmount($totalInterestAmount);
      $address->setYapayBaseInterestAmount($baseTotalInterestAmount);

      $address->setGrandTotal($address->getGrandTotal() + $address->getYapayInterestAmount());
      $address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getYapayBaseInterestAmount());
    }

    return $this;
  }

  public function fetch(Mage_Sales_Model_Quote_Address $address) {
    $amount = $address->getYapayInterestAmount();
    if ($amount != 0) {
      $address->addTotal(array('code' => $this->getCode(),
          'title' => Mage::helper('eloom_yapay')->__('Interest'),
          'value' => $amount
      ));
    }
    return $this;
  }

}
