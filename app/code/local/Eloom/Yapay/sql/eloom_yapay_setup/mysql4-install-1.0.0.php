<?php

##eloom.licenca##

$installer = $this;
$installer->startSetup();
$conn = $installer->getConnection();

$salesOrderTable = $installer->getTable('sales/order');
if (!$conn->tableColumnExists($salesOrderTable, 'yapay_discount_amount')) {
  $conn->addColumn($salesOrderTable, 'yapay_discount_amount', 'DECIMAL(10,4) NOT NULL');
}
if (!$conn->tableColumnExists($salesOrderTable, 'yapay_base_discount_amount')) {
  $conn->addColumn($salesOrderTable, 'yapay_base_discount_amount', 'DECIMAL(10,4) NOT NULL');
}
if (!$conn->tableColumnExists($salesOrderTable, 'yapay_interest_amount')) {
	$conn->addColumn($salesOrderTable, 'yapay_interest_amount', 'DECIMAL(10,4) NOT NULL');
}
if (!$conn->tableColumnExists($salesOrderTable, 'yapay_base_interest_amount')) {
	$conn->addColumn($salesOrderTable, 'yapay_base_interest_amount', 'DECIMAL(10,4) NOT NULL');
}

$quoteTableAddress = $installer->getTable('sales/quote_address');
if (!$conn->tableColumnExists($quoteTableAddress, 'yapay_discount_amount')) {
  $conn->addColumn($quoteTableAddress, 'yapay_discount_amount', 'DECIMAL(10,4) NOT NULL');
}
if (!$conn->tableColumnExists($quoteTableAddress, 'yapay_base_discount_amount')) {
  $conn->addColumn($quoteTableAddress, 'yapay_base_discount_amount', 'DECIMAL(10,4) NOT NULL');
}
if (!$conn->tableColumnExists($quoteTableAddress, 'yapay_interest_amount')) {
	$conn->addColumn($quoteTableAddress, 'yapay_interest_amount', 'DECIMAL(10,4) NOT NULL');
}
if (!$conn->tableColumnExists($quoteTableAddress, 'yapay_base_interest_amount')) {
	$conn->addColumn($quoteTableAddress, 'yapay_base_interest_amount', 'DECIMAL(10,4) NOT NULL');
}

$invoiceTable = $installer->getTable('sales/invoice');
if (!$conn->tableColumnExists($invoiceTable, 'yapay_discount_amount')) {
  $conn->addColumn($invoiceTable, 'yapay_discount_amount', 'DECIMAL(10,4) NOT NULL');
}
if (!$conn->tableColumnExists($invoiceTable, 'yapay_base_discount_amount')) {
  $conn->addColumn($invoiceTable, 'yapay_base_discount_amount', 'DECIMAL(10,4) NOT NULL');
}
if (!$conn->tableColumnExists($invoiceTable, 'yapay_interest_amount')) {
	$conn->addColumn($invoiceTable, 'yapay_interest_amount', 'DECIMAL(10,4) NOT NULL');
}
if (!$conn->tableColumnExists($invoiceTable, 'yapay_base_interest_amount')) {
	$conn->addColumn($invoiceTable, 'yapay_base_interest_amount', 'DECIMAL(10,4) NOT NULL');
}

if (!$conn->tableColumnExists($this->getTable('sales/order_payment'), 'boleto_cancellation')) {
	$installer->run("ALTER TABLE {$this->getTable('sales/order_payment')} ADD `boleto_cancellation` DATETIME");
}

if (!$conn->tableColumnExists($this->getTable('sales/order_payment'), 'token_transaction')) {
	$installer->run("ALTER TABLE {$this->getTable('sales/order_payment')} ADD `token_transaction` VARCHAR (40)");
}

$installer->endSetup();
