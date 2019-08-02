<?php

##eloom.licenca##

class Eloom_Yapay_Model_Cron extends Mage_Core_Model_Abstract {

  private $logger;

  /**
   * Initialize resource model
   */
  protected function _construct() {
    $this->logger = Eloom_Bootstrap_Logger::getLogger(__CLASS__);
    parent::_construct();
  }

  public function waitingPaymentTransaction() {
    $this->logger->info('Pedidos com Status [pending] - início');

	  $collection = Mage::getResourceModel('sales/order_payment_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('method', array('in' => array(Eloom_Yapay_Model_Method_Cc::PAYMENT_METHOD_CC_CODE,
																												     Eloom_Yapay_Model_Method_Boleto::PAYMENT_METHOD_BOLETO_CODE,
																														 Eloom_Yapay_Model_Method_Terminal::PAYMENT_METHOD_TERMINAL_CODE)))
            ->addFieldToFilter('cc_status', Eloom_Yapay_Enum_Transaction_Status::AGUARDANDO_PAGAMENTO);

	  if ($collection->getSize()) {
		  $tokenAccount = Eloom_Yapay_Configuration_Configure::getAccountCredentials()->getToken();

		  foreach ($collection as $payment) {
			  try {
				  $order = Mage::getModel('sales/order')->load($payment->getParentId());
				  Mage::getModel('eloom_yapay/transaction_code')->synchronizeTransaction($tokenAccount, $payment, $order);
			  } catch (Exception $exc) {
				  $this->logger->error(sprintf("Erro ao verificar Pagamento [%s] [%s]", $payment->getId(), $exc->getMessage()));
			  }
		  }
	  }

    $this->logger->info('Pedidos com Status [pending] - fim');
  }

  public function cancelOrderWithPaymentExpired() {
    $this->logger->info('Pagamento Expirado - Inicio');
    $config = Mage::helper('eloom_yapay/config');

    if ($config->isBoletoCancel()) {
      $collection = Mage::getModel('sales/order')->getCollection();
      $collection->getSelect()->join(array('p' => $collection->getResource()->getTable('sales/order_payment')), 'p.parent_id = main_table.entity_id', array());

      $collection->addFieldToSelect('increment_id');
      $collection->addFieldToFilter('status', array('eq' => $config->getNewOrderStatus()));
      $collection->addFieldToFilter('method', Eloom_Yapay_Model_Method_Boleto::PAYMENT_METHOD_BOLETO_CODE);
      $collection->addAttributeToFilter('p.boleto_cancellation', array('lt' => date('Y-m-d H:i:s', strtotime('now'))));

      if ($collection->getSize()) {
        foreach ($collection as $order) {
          try {
            $order = Mage::getModel('sales/order')->loadByIncrementId($order->getIncrementId());
            Mage::getModel('eloom_yapay/order')->cancel($order, 'Prazo de pagamento expirado.');
          } catch (Exception $e) {
            $this->logger->error($e->getMessage());
          }
        }
      }
    }

    $this->logger->info('Pagamento Expirado - Fim');
  }

}
