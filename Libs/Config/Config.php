<?php

namespace Libs\Config;


class Config
{
	/**
	 * @var Config
	 */
	private static $instance;

	/**
	 * Loaded configuration
	 *
	 * @var array
	 */
	private $config = array();

	protected function __construct() {
		$config_file = __DIR__ . '/../../config.ini';

		if (!file_exists($config_file))
			throw new \Exception('ERR-0007: Configuration file not found !'); //Can add additional info for specific users to show the file location

		$this->config = parse_ini_file($config_file, true); //Config file can be passed as parameter
	}

	/**
	 * Get instance
	 *
	 * @return Config
	 */
	public static function getInstance() {
		if (null === static::$instance) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Get config array
	 *
	 * @return array
	 */
	public function getConfig() {
		return $this->config;
	}

	//TODO add method to return given configuration value
}