<?php

/* * *
 * Represent a parameter item
 */

class Eloom_Yapay_Domains_Parameter {
	/*   * *
	 * Allow add extra information to order
	 *
	 * @var string
	 */

	private $key;

	/*   * *
	 * Value of corresponding key
	 *
	 * @var mixed
	 */
	private $value;

	/*   * *
	 * Used for the index of values of parameter
	 * @var mixed
	 */
	private $index;

	/*   * *
	 * Gets the parameter item key
	 * @return string
	 */

	public function getKey() {
		return $this->key;
	}

	/*   * *
	 * Sets the parameter item key
	 *
	 * @param string $key
	 */

	public function setKey($key) {
		$this->key = $key;
		return $this;
	}

	/*   * *
	 * Gets parameter item value
	 * @return string
	 */

	public function getValue() {
		return $this->value;
	}

	/*   * *
	 * Sets parameter item value
	 *
	 * @param string $value
	 */

	public function setValue($value) {
		$this->value = $value;
		return $this;
	}

	/*   * *
	 * Gets parameter index
	 *
	 * @return int
	 */

	public function getIndex() {
		return $this->index;
	}

	/*   * *
	 * Sets parameter item group
	 *
	 * @param int $group
	 */

	public function setIndex($index) {
		$this->index = (int)$index;
		return $this;
	}

}
