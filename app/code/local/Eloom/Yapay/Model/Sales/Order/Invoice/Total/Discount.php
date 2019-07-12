<?php

##eloom.licenca##

class Eloom_Yapay_Model_Sales_Order_Invoice_Total_Discount extends Mage_Sales_Model_Order_Invoice_Total_Abstract {

  protected $_code = 'eloom_yapay_discount';

  public function collect(Mage_Sales_Model_Order_Invoice $invoice) {
    parent::collect($invoice);
    $order = $invoice->getOrder();
    $baseTotalDiscountAmount = $order->getYapayBaseDiscountAmount();
    $totalDiscountAmount = Mage::app()->getStore()->convertPrice($baseTotalDiscountAmount);

    $invoice->setYapayDiscountAmount($totalDiscountAmount);
    $invoice->setYapayBaseDiscountAmount($baseTotalDiscountAmount);

    $invoice->setGrandTotal($invoice->getGrandTotal() + $invoice->getYapayDiscountAmount());
    $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $invoice->getYapayBaseDiscountAmount());

    return $this;
  }

}
