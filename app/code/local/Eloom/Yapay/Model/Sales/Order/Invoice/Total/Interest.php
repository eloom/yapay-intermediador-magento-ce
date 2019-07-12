<?php

##eloom.licenca##

class Eloom_Yapay_Model_Sales_Order_Invoice_Total_Interest extends Mage_Sales_Model_Order_Invoice_Total_Abstract {

  protected $_code = 'eloom_yapay_interest';

  public function collect(Mage_Sales_Model_Order_Invoice $invoice) {
    parent::collect($invoice);
    $order = $invoice->getOrder();
    $baseTotalInterestAmount = $order->getYapayBaseInterestAmount();
    $totalInterestAmount = Mage::app()->getStore()->convertPrice($baseTotalInterestAmount);

    $invoice->setYapayInterestAmount($totalInterestAmount);
    $invoice->setYapayBaseInterestAmount($baseTotalInterestAmount);

    $invoice->setGrandTotal($invoice->getGrandTotal() + $invoice->getYapayInterestAmount());
    $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $invoice->getYapayBaseInterestAmount());

    return $this;
  }

}
