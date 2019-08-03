<?php

##eloom.licenca##

class Eloom_Yapay_Model_Order extends Mage_Core_Model_Abstract {

  private $logger;
  private $_messages = array(
  	  'NOT_FOUND' => 'Pedido não localizado na Yapay',
      'AGUARDANDO_PAGAMENTO' => 'Pedido criado na Yapay.',
      'EM_PROCESSAMENTO' => 'Pedido está sendo processado na Yapay.',
      'APROVADA' => 'Pedido autorizado na Yapay.',
      'CANCELADA' => 'Pedido cancelado na Yapay.',
      'REPROVADA' => 'Pedido rejeitado na Yapay.',
      'EM_CONTESTACAO' => 'Pedido em contestação na Yapay.',
	    'EM_MONITORAMENTO' => 'Pedido em Monitoramento na Yapay.'
  );

  /**
   * Initialize resource model
   */
  protected function _construct() {
    $this->logger = Eloom_Bootstrap_Logger::getLogger(__CLASS__);
  }

  /**
   * Initialize order model instance
   *
   * @return Mage_Sales_Model_Order || false
   */
  protected function _initOrder($orderId) {
    $order = Mage::getModel('sales/order')->load($orderId);
    if (!$order->getId()) {
      throw new Exception($this->__('This order no longer exists.'));
    }
    return $order;
  }

  public function cancel($order, $comment) {
    try {
      if ($order->getState() == Mage_Sales_Model_Order::STATE_CANCELED) {
        return true;
      }
      /*
       * Call Yapay
       */
	    $accountCredentials = Eloom_Yapay_Configuration_Configure::getAccountCredentials();
	    $appCredentials = Eloom_Yapay_Configuration_Configure::getApplicationCredentials();

	    $response = Eloom_Yapay_Services_Authorization_Create::create($accountCredentials, $appCredentials);
	    $accessToken = Eloom_Yapay_Services_Authorization_Token::getAccessToken($response->getCode(), $appCredentials);

	    $response = Eloom_Yapay_Services_Transactions_Cancel::cancel($accessToken->getAccessToken(), $order->getPayment()->getLastTransId());

			if($response->message != 'success') {
				// FIXME: enviar notificação pro admin
				$this->logger->fatal(sprintf("Impossível cancelar pedido %s", $order->getIncrementId()));
				return;
			}

      $c = trim($comment);
      $order->cancel()
              ->addStatusHistoryComment($c)
              ->setIsVisibleOnFront(true)
              ->setIsCustomerNotified(true);

      if ($order->hasInvoices() != '') {
        $order->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, $this->__('Não foi possível retornar os produtos ao estoque pois há faturas relacionadas a este pedido.'), false);
      }
      $order->save();

      if ($order->getPayment()) {
        if (!$order->getPayment()->getCcStatus() || $order->getPayment()->getCcStatus() == '') {
          $order->getPayment()->setCcStatus(Eloom_Yapay_Enum_Transaction_Status::CANCELADA);
        }
        $order->getPayment()->save();
      }

      try {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
        $sql = "UPDATE " . Mage::getConfig()->getTablePrefix() . "sales_flat_order_grid SET status = 'canceled' WHERE increment_id = " . $order->getIncrementId();
        $connection->query($sql);
      } catch (Exception $ex) {
        
      }
			if($this->logger->isDebugEnabled()) {
				$this->logger->debug(sprintf("Pedido %s [CANCELADO]. Motivo [%s]", $order->getIncrementId(), $c));
			}
    } catch (Exception $e) {
      try {
        $this->logger->info(sprintf("Forçando cancelamento do pedido [%s].", $order->getIncrementId()));
        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
        $sql = "UPDATE " . Mage::getConfig()->getTablePrefix() . "sales_flat_order SET state = 'canceled', status = 'canceled' WHERE increment_id = " . $order->getIncrementId();
        $connection->query($sql);

        $sql = "UPDATE " . Mage::getConfig()->getTablePrefix() . "sales_flat_order_grid SET status = 'canceled' WHERE increment_id = " . $order->getIncrementId();
        $connection->query($sql);
      } catch (Exception $ex) {
        
      }
    }
  }

  public function processTransaction($order, $status) {
    $comment = $this->_messages[Eloom_Yapay_Enum_Transaction_Status::getType($status)];

		$config = Mage::helper('eloom_yapay/config');
    switch ($status) {
      case Eloom_Yapay_Enum_Transaction_Status::AGUARDANDO_PAGAMENTO:
        $order->addStatusHistoryComment($comment, $config->getNewOrderStatus());
        $order->setIsVisibleOnFront(true);
        $order->save();
        $order->sendOrderUpdateEmail(true, $comment);
        break;

      case Eloom_Yapay_Enum_Transaction_Status::EM_PROCESSAMENTO:
				$order->addStatusHistoryComment($comment, null);
				$order->setIsVisibleOnFront(true);
				$order->save();
				$order->sendOrderUpdateEmail(true, $comment);
				break;

			case Eloom_Yapay_Enum_Transaction_Status::APROVADA:
				$status = $config->getApprovedOrderStatus();

        if ($order->getState() != $status) {
          $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
          $order->addStatusHistoryComment($comment, $status);
          $order->setIsVisibleOnFront(true);
          $order->save();
          $order->sendOrderUpdateEmail(true, $comment);

          if ($order->canInvoice()) {
            $invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice();
            $invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_ONLINE);
            $invoice->register();
            $transactionSave = Mage::getModel('core/resource_transaction')
                    ->addObject($invoice)
                    ->addObject($invoice->getOrder());
            $transactionSave->save();

            $invoice->getOrder()->setIsInProcess(true);
            $invoice->getOrder()->addStatusHistoryComment('Fatura gerada automaticamente.');
            $invoice->sendEmail(true, '');

            $order->save();
          }
        }
        break;

      case Eloom_Yapay_Enum_Transaction_Status::CANCELADA:
			case Eloom_Yapay_Enum_Transaction_Status::REPROVADA:
        $this->cancel($order, $comment);
        break;

			case Eloom_Yapay_Enum_Transaction_Status::EM_CONTESTACAO:
				$order->setState(Mage_Sales_Model_Order::STATE_HOLDED, true);
				$order->addStatusHistoryComment($comment, Mage_Sales_Model_Order::STATE_HOLDED);
				$order->setIsVisibleOnFront(true);
				$order->save();
				$order->sendOrderUpdateEmail(true, $comment);
				break;
    }
  }
}
