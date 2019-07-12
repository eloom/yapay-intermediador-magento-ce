<?php

/**
 * Class Status
 * @package Yapay\Enum\Transaction
 */
class Eloom_Yapay_Enum_Transaction_Status extends Eloom_Yapay_Enum_Enum {

	const NOT_FOUND = 0;

	const AGUARDANDO_PAGAMENTO = 4;

	const EM_PROCESSAMENTO = 5;

	const APROVADA = 6;

	const CANCELADA = 7;

	const EM_CONTESTACAO = 24;

	const EM_MONITORAMENTO = 87;

	const REPROVADA = 89;
}
