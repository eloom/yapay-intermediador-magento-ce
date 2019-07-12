<?php

##eloom.licenca##

class Eloom_Yapay_TerminalController extends Mage_Core_Controller_Front_Action {

	const FAILURE = 'eloomyapay/terminal/failure';

	const SUCCESS = 'eloomyapay/terminal/success';

	private $logger;

	protected function _construct() {
		$this->logger = Eloom_Bootstrap_Logger::getLogger(__CLASS__);
		parent::_construct();
	}

	public function indexAction() {
		$orderIncrementId = $this->getRequest()->getParam('id');
		$hash = $this->getRequest()->getParam('hash');

		$order = Mage::getModel('sales/order')->loadByIncrementId($orderIncrementId);

		$state = $order->getState();
		if ($state != Mage_Sales_Model_Order::STATE_NEW) {
			Mage::getSingleton('core/session')->addNotice('Somente pedidos com status "Pendente" poderão ser pagos nesta modalidade.');
			$this->_redirect('checkout/cart');
			return;
		}
		Mage::getSingleton('eloom_yapay/session')->setOrder($order);

		$helper = Mage::helper('eloom_yapay');
		$config = Mage::helper('eloom_yapay/config');
		$signature = $helper->generateSignature($config->getToken(), $orderIncrementId, 'BRL');

		if ($signature != $hash) {
			Mage::getSingleton('core/session')->addNotice('A Hash recebida na URL não confere com a Hash gerada no pedido. Verifique se o link informado é igual ao que recebeu por email.');
			$this->_redirect('checkout/cart');
			return;
		}

		$this->loadLayout();
		$this->renderLayout();
	}

	public function savePaymentAction() {
		if (!$this->getRequest()->isPost()) {
			return;
		}

		$data = $this->getRequest()->getPost('payment', array());
		$data = new Varien_Object($data);
		$message = null;
		if ($data->getMethod() == 'terminal_cc') {
			$message = $this->processPaymentCc($data);
		} else if ($data->getMethod() == 'terminal_boleto') {
			$message = $this->processPaymentBoleto();
		}

		$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($message));
	}

	private function processPaymentBoleto() {
		$order = Mage::getSingleton('eloom_yapay/session')->getOrder();
		$message = array();

		try {
			$response = Mage::getModel('eloom_yapay/boleto_request')->generatePaymentRequest($order);

			/* link boleto */
			$additionalData = new stdClass();
			$additionalData->yapayOrderId = $response->getOrderNumber();
			$additionalData->paymentLink = $response->getPayment()->getUrlPayment();
			$additionalData->barCode = $response->getPayment()->getLinhaDigitavel();

			$order->getPayment()->setAdditionalData(json_encode($additionalData));
			$order->getPayment()->setCcStatus($response->getStatusId());
			$order->getPayment()->setLastTransId($response->getTransactionId());
			$order->getPayment()->setTokenTransaction($response->getTokenTransaction());

			// calcular data para cancelar boleto
			$orderCreatedAt = $order->getCreatedAt();
			$config = Mage::helper('eloom_yapay/config');
			$dayOfWeek = date("w", strtotime($orderCreatedAt));
			$incrementDays = null;

			switch ($dayOfWeek) {
				case 5: // Sexta-Feira
					$incrementDays = $config->getBilletCancelOnFriday();
					break;

				case 6: // Sabado
					$incrementDays = $config->getBilletCancelOnSaturday();
					break;

				default:
					$incrementDays = $config->getBilletCancelOnSunday();
					break;
			}

			$totalDays = $config->getBilletExpiration() + $incrementDays;
			$cancellationDate = strftime("%Y-%m-%d %H:%M:%S", strtotime("$orderCreatedAt +$totalDays day"));
			$order->getPayment()->setBoletoCancellation($cancellationDate);
			$order->getPayment()->save();

			Mage::dispatchEvent('eloom_yapay_process_transaction', array('order' => $order, 'status' => $response->getStatusId()));

			switch ($response->getStatusId()) {
				case Eloom_Yapay_Enum_Transaction_Status::AGUARDANDO_PAGAMENTO:
					Mage::getSingleton('checkout/type_onepage')->getCheckout()->setLastSuccessQuoteId(true);
					if ($order->getCanSendNewEmailFlag() && !$order->getEmailSent()) {
						try {
							$order->sendNewOrderEmail();
						} catch (Exception $e) {
							$this->logger->fatal($e->getTraceAsString());
						}
					}

					$message = array('url' => Mage::getBaseUrl(), 'message' => sprintf("<ul><li>%s</li><li>%s</li></ul>", $this->__('Your payment was processed by Yapay'), $this->__('Billett will be sent to your email.')));
					break;
			}
		} catch (Eloom_Yapay_UnprocessableEntityException $e) {
			$this->logger->fatal($e->getCode() . ' - ' . $e->getMessage());

			$order->getPayment()->setCcStatus(Eloom_Yapay_Enum_Transaction_Status::NOT_FOUND);
			$order->getPayment()->setCcDebugResponseBody(json_encode($e->getErrors()));
			$order->getPayment()->save();

			Mage::dispatchEvent('eloom_yapay_cancel_order', array('order' => $order, 'comment' => 'Falha no Pagamento.'));

			$message = array('error' => "<ul><li>" . implode("</li><li>", $e->getErrors()) . "</li></ul>");
		}

		return $message;
	}

	private function processPaymentCc(Varien_Object $data) {
		$order = Mage::getSingleton('eloom_yapay/session')->getOrder();
		$message = array();

		$ccNumber = preg_replace('/\D/', '', $data->getYapayCcNumber());
		$order->getPayment()->setCcName($data->getYapayCcName())
			->setCcOwner($data->getYapayCcOwner())
			->setCcLast4(substr($ccNumber, -4))
			->setCcType($data->getYapayCcType())
			->setCcCvc($data->getYapayCcCvc())
			->setCcInstallments($data->getYapayCcInstallments())
			->setCcNumber($ccNumber);

		$expiry = null;
		if ($data->getYapayCcExpiry() && $data->getYapayCcExpiry() != '') {
			$expiry = explode("/", trim($data->getYapayCcExpiry()));
			$month = trim($expiry[0]);
			$year = trim($expiry[1]);
			if (strlen($year) == 2) {
				$year = '20' . $year;
			}
			$expiry = $year . '/' . $month;
			$order->getPayment()->setCcExpiry($expiry);
		}

		// salva
		$additional = new stdClass();
		$additional->creditCardNumber = Mage::helper('core')->encrypt($ccNumber);
		$additional->creditCardHolderName = $data->getYapayCcOwner();
		$additional->creditCardCvc = $data->getYapayCcCvc();
		$additional->creditCardExpiry = $expiry;

		$additional->installments = $data->getYapayCcInstallments();
		if ($data->getYapayCcHolderAnother() && $data->getYapayCcHolderAnother() == 1) {
			$additional->creditCardHolderAnother = $data->getYapayCcHolderAnother();
			$additional->creditCardHolderCpf = $data->getYapayCcHolderCpf();
			$additional->creditCardHolderPhone = $data->getYapayCcHolderPhone();
			$additional->creditCardHolderBirthDate = $data->getYapayCcHolderBirthDate();
		}

		$serializedValue = json_encode($additional);
		$order->getPayment()->setAdditionalData($serializedValue);
		$order->getPayment()->save();

		/**
		 * Envia o Pagamento
		 */
		try {
			$response = Mage::getModel('eloom_yapay/cc_request')->generatePaymentRequest($order);

			$additionalData = json_decode($order->getPayment()->getAdditionalData());
			$additionalData->creditCardNumber = null;
			$additionalData->creditCardCvc = null;

			$order->getPayment()->setCcStatus($response->getStatusId());
			$additionalData->yapayOrderId = $response->getOrderNumber();

			$order->getPayment()->setAdditionalData(json_encode($additionalData));
			$order->getPayment()->setLastTransId($response->getTransactionId());
			$order->getPayment()->setTokenTransaction($response->getTokenTransaction());
			$order->getPayment()->setCcDebugResponseBody('');
			$order->getPayment()->save();

			Mage::dispatchEvent('eloom_yapay_process_transaction', array('order' => $order, 'status' => $response->getStatusId()));

			switch ($response->getStatusId()) {
				case Eloom_Yapay_Enum_Transaction_Status::AGUARDANDO_PAGAMENTO:
				case Eloom_Yapay_Enum_Transaction_Status::EM_PROCESSAMENTO:
				case Eloom_Yapay_Enum_Transaction_Status::APROVADA:
					Mage::getSingleton('checkout/type_onepage')->getCheckout()->setLastSuccessQuoteId(true);
					if ($order->getCanSendNewEmailFlag() && !$order->getEmailSent()) {
						try {
							$order->sendNewOrderEmail();
						} catch (Exception $e) {
							$this->logger->fatal($e->getTraceAsString());
						}
					}
				$message = array('url' => Mage::getBaseUrl(), 'message' => "<ul><li>" . $this->__('Your payment was processed by Yapay') . "</li></ul>");
					break;
			}
		} catch (Eloom_Yapay_UnprocessableEntityException $e) {
			$this->logger->fatal($e->getCode() . ' - ' . $e->getMessage());

			$order->getPayment()->setCcStatus(Eloom_Yapay_Enum_Transaction_Status::NOT_FOUND);
			$order->getPayment()->setCcDebugResponseBody(json_encode($e->getErrors()));
			$order->getPayment()->save();

			Mage::dispatchEvent('eloom_yapay_cancel_order', array('order' => $order, 'comment' => 'Falha no Pagamento.'));

			$message = array('error' => "<ul><li>" . implode("</li><li>", $e->getErrors()) . "</li></ul>");
		}

		return $message;
	}
}
