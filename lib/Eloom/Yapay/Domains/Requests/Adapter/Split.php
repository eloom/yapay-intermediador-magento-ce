<?php

use Yapay\Domains\Requests\Split\Primary;
use Yapay\Domains\Requests\Split\Receiver;

/**
 * Class Split
 * @package Yapay\Domains\Requests\Adapter
 */
class Eloom_Yapay_Domains_Requests_Adapter_Split {
	use Receiver;
	use Primary;

	/**
	 * @var
	 */
	private $split;

	/**
	 * Split constructor.
	 * @param $split
	 */
	public function __construct($split) {
		$this->split = $split;
	}
}
