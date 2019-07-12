<?php

##eloom.licenca##

class Eloom_Yapay_Errors {

	public static $list = array(
		'401' => array('message' => 'Não foi possível conectar com o Yapay. Por favor, verifique se seu convênio está correto.'),
		'-999' => array('message' => 'Houve um erro ao processar sua requisição. Por favor tente novamente, ou escolha outra forma de pagamento.'),
		'001001' => array('message' => 'Token inválido ou não encontrado.'),
		'003003' => array('message' => 'Forma de Pagamento Inválida.'),
		'003004' => array('message' => 'Número da Parcela Inválido.'),
		'003011' => array('message' => 'Numero do cartão inválido.'),
		'003012' => array('message' => 'Nome do cartão em branco.'),
		'003014' => array('message' => 'Código de segurança inválido.'),
		'003015' => array('message' => 'Mês de vencimento do cartão inválido.'),
		'003020' => array('message' => 'Ano de vencimento do cartão inválido.'),
		'003021' => array('message' => 'O vendedor não pode ser igual ao comprador. O email e CPF/CNPJ do cliente não podem ser iguais aos do vendedor cadastrado na Yapay.'),
		'003065' => array('message' => 'Valor menor que mínimo permitido.'),
		'003039' => array('message' => 'Vendedor inválido ou não encontrado.'),
		'009006' => array('message' => 'Número de parcelas maior que o permitido.'),
		'058001' => array('message' => 'Revendedor inválido.'),
	);

	/**
	 *
	 * @var string
	 */
	private $code;

	/**
	 *
	 * @var string
	 */
	private $message;

	public function __construct($code) {
		if (array_key_exists($code, self::$list)) {
			$v = self::$list[$code];

			$this->code = $code;
			$this->message = $v['message'];
		} else {
			$this->code = $code;
			$this->message = 'Não foi possível processar o pagamento.';
		}
	}

	public function getCode() {
		return $this->code;
	}

	public function getMessage() {
		return $this->message;
	}

	public function setCode($code) {
		$this->code = $code;
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	public static function listAll() {
		return self::$list;
	}

	public function getFullMessage() {
		return $this->code . ' - ' . $this->message;
	}

}
