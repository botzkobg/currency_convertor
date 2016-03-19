<?php

namespace Libs\Source;


use Exception;
use Libs\Config\Config;

class SourceFactory
{
	/**
	 * @var ISource
	 */
	protected static $source;

	/**
	 * Get the data Source
	 *
	 * @return ISource
	 */
	public static function getSource() {
		if (empty(static::$source))
			static::$source = static::create();

		return static::$source;
	}

	/**
	 * @throws Exception
	 */
	public static function create() {
		$config = Config::getInstance()->getConfig();
		switch ($config['Source']['type']) {
			case 'File':
				return static::createFromFile($config);

			default:
				throw new Exception("ERR-0004: Source type '{$config['Source']['type']}' is not implemented !");
		}
	}

	/**
	 * Create ISource from file
	 *
	 * @param $config
	 * @return ISource
	 * @throws Exception
	 */
	protected static function createFromFile($config) {
		switch($config['SourceFile']['type']) {
			case 'CSV':
				return new CSVFile($config['SourceFile']['location']);

			default:
				throw new Exception("ERR-0006: File type '{$config['SourceFile']['type']}' is not implemented !");
		}
	}
}