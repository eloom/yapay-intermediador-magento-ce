<?php

##eloom.licenca##

class Eloom_Yapay_Helper_Config extends Mage_Core_Helper_Abstract {

	const WEB_CHECKOUT_PAYMENT_LINK = 'eloomyapay/terminal/index/id/%s/hash/%s';

  /**
   * Token
   */
  const XML_PATH_TOKEN = 'payment/eloom_yapay/token';


  /**
   * Ambiente
   */
  const XML_PATH_ENVIRONMENT = 'payment/eloom_yapay/environment';

	/**
	 * Status para Novos Pedidos
	 */
	const XML_PATH_NEW_ORDER_STATUS = 'payment/eloom_yapay/new_order_status';

	/**
	 * Status para Pedidos Aprovados
	 */
	const XML_PATH_APPROVED_ORDER_STATUS = 'payment/eloom_yapay/approved_order_status';

	/**
	 * Forma de Recebimento
	 */
	const XML_PATH_PAYMENT_CC_RECEIPT = 'payment/eloom_yapay_cc/receipt';

	/**
	 * Total de Parcelas
	 */
	const XML_PATH_PAYMENT_CC_TOTAL_INSTALLMENTS = 'payment/eloom_yapay_cc/total_installmens';

	/**
	 * Parcelas sem Juros
	 */
	const XML_PATH_PAYMENT_CC_INSTALLMENTS_WITHOU_INTEREST = 'payment/eloom_yapay_cc/installmens_without_interest';

	/**
	 * Juros
	 */
	const XML_PATH_PAYMENT_CC_INTEREST = 'payment/eloom_yapay_cc/interest';

  /**
   * Desconto à Vista
   */
  const XML_PATH_PAYMENT_CC_DISCOUNT = 'payment/eloom_yapay_cc/discount';

  /**
   * Parcela Mínima
   */
  const XML_PATH_PAYMENT_CC_MIN_INSTALLMENT = 'payment/eloom_yapay_cc/min_installment';


	/**
	 * Instruções do Boleto
	 */
	const XML_PATH_PAYMENT_BOLETO_INSTRUCTIONS = 'payment/eloom_yapay_boleto/instructions';

  /**
   * Expiração do Boleto
   */
  const XML_PATH_PAYMENT_BOLETO_EXPIRATION = 'payment/eloom_yapay_boleto/expiration';

  /**
   * Cancelamento do Boleto
   */
  const XML_PATH_PAYMENT_BOLETO_CANCEL = 'payment/eloom_yapay_boleto/cancel';

  /**
   * Prazo de Expiração para compras realizadas na Sexta-Feira via Boleto
   */
  const XML_PATH_PAYMENT_BOLETO_CANCEL_ON_FRIDAY = 'payment/eloom_yapay_boleto/cancel_on_friday';

  /**
   * Prazo de Expiração para compras realizadas no Sábado via Boleto
   */
  const XML_PATH_PAYMENT_BOLETO_CANCEL_ON_SATURDAY = 'payment/eloom_yapay_boleto/cancel_on_saturday';

  /**
   * Prazo de Expiração para compras realizadas entre Domingo e Quinta-Feira via Boleto
   */
  const XML_PATH_PAYMENT_BOLETO_CANCEL_ON_SUNDAY = 'payment/eloom_yapay_boleto/cancel_on_sunday';

  /**
   * 
   */
  public function _construct() {
    parent::_construct();
  }

  /**
   * Retrieve store model instance
   *
   * @return Mage_Core_Model_Store
   */
  public function getStore() {
    return Mage::app()->getStore();
  }

  public function getConfig($path) {
    return Mage::getStoreConfig($path, Mage::app()->getStore()->getStoreId());
  }

  public function getConfigFlag($path) {
    return Mage::getStoreConfigFlag($path, Mage::app()->getStore()->getStoreId());
  }

  public function getToken() {
    return trim($this->getConfig(self::XML_PATH_TOKEN));
  }

  public function getEnvironment() {
    return trim($this->getConfig(self::XML_PATH_ENVIRONMENT));
  }

  public function isInProduction() {
    $env = trim($this->getConfig(self::XML_PATH_ENVIRONMENT));
    if ($env === Eloom_Yapay_Domains_Environment::PRODUCTION) {
      return true;
    }

    return false;
  }

  public function getPaymentCcDiscount() {
    return trim($this->getConfig(self::XML_PATH_PAYMENT_CC_DISCOUNT));
  }

  public function getPaymentCcMinInstallment() {
    return trim($this->getConfig(self::XML_PATH_PAYMENT_CC_MIN_INSTALLMENT));
  }

	public function getPaymentCcTotalInstallments() {
		return (int) $this->getConfig(self::XML_PATH_PAYMENT_CC_TOTAL_INSTALLMENTS);
	}

	public function getPaymentCcInstallmentsWithoutInterest() {
		return (int) $this->getConfig(self::XML_PATH_PAYMENT_CC_INSTALLMENTS_WITHOU_INTEREST);
	}

	public function getPaymentCcInterest() {
		return trim($this->getConfig(self::XML_PATH_PAYMENT_CC_INTEREST));
	}

  public function getBilletExpiration() {
    return (int) trim($this->getConfig(self::XML_PATH_PAYMENT_BOLETO_EXPIRATION));
  }

	public function getBilletInstructions() {
		return trim($this->getConfig(self::XML_PATH_PAYMENT_BOLETO_INSTRUCTIONS));
	}

  public function isBoletoCancel() {
    return $this->getConfigFlag(self::XML_PATH_PAYMENT_BOLETO_CANCEL);
  }

  public function getBilletCancelOnFriday() {
    return (int) trim($this->getConfig(self::XML_PATH_PAYMENT_BOLETO_CANCEL_ON_FRIDAY));
  }

  public function getBilletCancelOnSaturday() {
    return (int) trim($this->getConfig(self::XML_PATH_PAYMENT_BOLETO_CANCEL_ON_FRIDAY));
  }

  public function getBilletCancelOnSunday() {
    return (int) trim($this->getConfig(self::XML_PATH_PAYMENT_BOLETO_CANCEL_ON_SUNDAY));
  }

	/**
	 * Retorna verdadeiro se a forma de recebimento é por Antecipação
	 *
	 * @return bool
	 */
	public function isReceiptByAntecipacao() {
  	return ($this->getConfig(self::XML_PATH_PAYMENT_CC_RECEIPT) == 'A');
	}

	public function getNewOrderStatus() {
		return $this->getConfig(self::XML_PATH_NEW_ORDER_STATUS);
	}

	public function getApprovedOrderStatus() {
		return $this->getConfig(self::XML_PATH_APPROVED_ORDER_STATUS);
	}

}
