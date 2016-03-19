<?php

namespace Libs\Currency;

/**
 * Class Converter
 *
 * @package Libs\Currency
 */
class Converter {
	/**
	 * @var Currency
	 */
	protected $currency_from;
	/**
	 * @var Currency
	 */
	protected $currency_to;

	/**
	 * Get the convert course between given currencies
	 *
	 * @param string $from - currency code
	 * @param string $to - currency code
	 * @return float
	 */
	public function getConvertCourser($from, $to) {
		$this->loadCurrencyFrom($from);
		$this->loadCurrencyTo($to);

		return $this->currency_from->getCourse() / $this->currency_to->getCourse();
	}

	/**
	 * Convert given currencies
	 *
	 * @param string $from - currency code
	 * @param string $to - currency code
	 * @param double $quantity
	 * @return mixed
	 */
	public function convert($from, $to, $quantity) {
		return $quantity * $this->getConvertCourser($from, $to);
	}

	/**
	 * Load the currency to convert from
	 *
	 * @param string $code - currency code
	 */
	protected function loadCurrencyFrom($code) {
		$this->currency_from = $this->getCurrency($code, $this->currency_from);
	}

	/**
	 * Load the currency to convert to
	 *
	 * @param string $code - currency code
	 */
	protected function loadCurrencyTo($code) {
		$this->currency_to = $this->getCurrency($code, $this->currency_to);
	}

	/**
	 * Get currency from the source
	 *
	 * @param string $code - currency code
	 * @param Currency|null $current
	 * @return Currency
	 */
	protected function getCurrency($code, $current) {
		if (!empty($current) && $current->getCode() == $code)
			return $current;

		$raw_data = Currency::findByCode($code);

		return new Currency($raw_data['Code'], $raw_data['Course'], $raw_data['Name']);
	}
}