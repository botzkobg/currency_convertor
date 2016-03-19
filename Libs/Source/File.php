<?php

namespace Libs\Source;


abstract class File implements ISource
{
	/**
	 * File name with path
	 *
	 * @var string
	 */
	protected $file_name;
	protected $handle;

	/**
	 * File constructor.
	 *
	 * @param string $file_name
	 * @throws \Exception
	 */
	public function __construct($file_name) {
		$this->file_name = $file_name;

		if (!file_exists($this->file_name))
			throw new \Exception('ERR-0001: Source file does not exists !'); //If different user types for admin it an show the file location

		$this->handle = fopen($this->file_name, 'r');
		if ($this->handle === false)
			throw new \Exception('ERR-0002: Can not read from the source file !'); //If different user types for admin it an show the file location
	}

	/**
	 * Close the file on exit
	 */
	public function __destruct() {
		if (isset($this->handle) && $this->handle !== false)
			fclose($this->handle);
	}

	/**
	 * Find a record by given ID
	 *
	 * Find a record by given identificator
	 *
	 * @param mix $id
	 * @return array
	 */
	abstract public function byID($id);
}