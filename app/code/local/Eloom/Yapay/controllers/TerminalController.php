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
		$tokenAccount = Eloom_Yapay_Configuration_Configure::getAccountCredentials()->getToken();
		$signature = $helper->generateSignature($tokenAccount, $orderIncrementId, 'BRL');

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
					$message = array('url' => Mage::getUrl('checkout/onepage/success', array('_secure' => true)), 'message' => sprintf("<ul><li>%s</li><li>%s</li></ul>", $this->__('Your payment was processed by Yapay'), $this->__('Billett will be sent to your email.')));
					break;
			}
		} catch (Eloom_Yapay_UnprocessableEntityException $e) {
			$this->logger->fatal($e->getCode() . ' - ' . $e->getMessage());

			$order->getPayment()->setCcStatus(Eloom_Yapay_Enum_Transaction_Status::NOT_FOUND);
			$order->getPayment()->setCcDebugResponseBody(json_encode($e->getErrors()));
			$order->getPayment()->save();

			$message = array('error' => "<ul><li>" . implode("</li><li>", $e->getErrors()) . "</li></ul>");
		}

		return $message;
	}

	private function processPaymentCc(Varien_Object $data) {
		$data = $this->getRequest()->getPost('payment', array());
		$data = new Varien_Object($data);

		$serializedValue = null;
		if ($data->getYapayCcCvc()) {
			$additional = new stdClass();
			$additional->creditCardNumber = Mage::helper('core')->encrypt($data->getYapayCcNumber());
			$additional->creditCardHolderName = $data->getYapayCcOwner();
			$additional->creditCardCvc = Mage::helper('core')->encrypt($data->getYapayCcCvc());
			$additional->fingerPrint = $data->getYapayFingerPrint();

			if ($data->getYapayCcExpiry() && $data->getYapayCcExpiry() != '') {
				$expiry = explode("/", trim($data->getYapayCcExpiry()));
				$month = trim($expiry[0]);
				$year = trim($expiry[1]);
				if (strlen($year) == 2) {
					$year = '20' . $year;
				}
				$expiry = $year . '/' . $month;
				$additional->creditCardExpiry = $expiry;
			}

			$installments = 0;
			$installmentAmount = 0;

			$arrayex = explode('-', $data->getYapayCcInstallments());
			if (isset($arrayex[0])) {
				$installments = $arrayex[0];
				$installmentAmount = $arrayex[1];
			}

			$additional->installments = $installments;
			$additional->installmentAmount = $installmentAmount;

			if ($data->getYapayCcHolderAnother() && $data->getYapayCcHolderAnother() == 1) {
				$additional->creditCardHolderAnother = $data->getYapayCcHolderAnother();
				$additional->creditCardHolderCpf = $data->getYapayCcHolderCpf();
				$additional->creditCardHolderPhone = $data->getYapayCcHolderPhone();
				$additional->creditCardHolderBirthDate = $data->getYapayCcHolderBirthDate();
			}

			$serializedValue = json_encode($additional);
		}
		$order = Mage::getSingleton('eloom_yapay/session')->getOrder();
		$order->getPayment()->setAdditionalData($serializedValue);
		$order->save();

		$message = array();

		/**
		 * Envia o Pagamento
		 */
		try {
			$response = Mage::getModel('eloom_yapay/cc_request')->generatePaymentRequest($order);

			switch ($response->getStatusId()) {
				case Eloom_Yapay_Enum_Transaction_Status::AGUARDANDO_PAGAMENTO:
				case Eloom_Yapay_Enum_Transaction_Status::EM_MONITORAMENTO:
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
				Mage::getSingleton('checkout/session')->setLastRealOrderId($order->getId());
				$message = array('url' => Mage::getUrl('checkout/onepage/success', array('_secure' => true)), 'message' => sprintf("<ul><li>%s</li><li>%s</li></ul>", $this->__('Your payment was processed by Yapay'), $this->__('Billett will be sent to your email.')));
					break;
			}
		} catch (Eloom_Yapay_UnprocessableEntityException $e) {
			$this->logger->fatal($e->getCode() . ' - ' . $e->getMessage());

			$order->getPayment()->setCcStatus(Eloom_Yapay_Enum_Transaction_Status::NOT_FOUND);
			$order->getPayment()->setCcDebugResponseBody(json_encode($e->getErrors()));
			$order->getPayment()->save();

			$message = array('error' => "<ul><li>" . implode("</li><li>", $e->getErrors()) . "</li></ul>");
		}

		return $message;
	}
}
