<?php

namespace Libs\Currency;
use Libs\Source\SourceFactory;

/**
 * Class Currency
 *
 * @package Libs\Currency
 */
class Currency {
	/**
	 * Currency name
	 *
	 * @var string
	 */
	protected $name;
	/**
	 * Currency code - 3 letters
	 *
	 * @var string
	 */
	protected $code;
	/**
	 * Course to convert the currency
	 *
	 * @var double
	 */
	protected $course;
	/**
	 * Source to get the data from
	 *
	 * @var //TODO
	 */
	protected $source;

	public function __construct($code, $course, $name = '') {
		$this->name = $name ? $name : $code;
		$this->code = $code;
		$this->course = $course;
	}

	/**
	 * Find currency by code
	 *
	 * TODO: add ISource as second parameter and if not passed use the default one
	 *
	 * @param $code
	 * @return Currency
	 */
	public static function findByCode($code) {
		return SourceFactory::getSource()->byID($code);
	}

	/**
	 * Get Name of the currency
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get Code of the currency
	 *
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * Get Course of the currency
	 *
	 * @return float
	 */
	public function getCourse()
	{
		return $this->course;
	}

	/**
	 * Set Name of the currency
	 *
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Set Code of the currency
	 *
	 * @param string $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}

	/**
	 * Set Course of the currency
	 *
	 * @param float $course
	 */
	public function setCourse($course)
	{
		$this->course = $course;
	}


}