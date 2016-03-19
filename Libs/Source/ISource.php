<?php

namespace Libs\Source;

/**
 * Interface ISource
 *
 * @package Libs\Source
 */
interface ISource {
	/**
	 * ISource constructor.
	 *
	 * Init the source
	 * If it's database then make a connection to the database
	 * If it's a file check file exists and open it (load it into the memory if needed)
	 *
	 * @param string $file_name
	 */
	public function __construct($file_name);

	/**
	 * Find a record by given ID
	 *
	 * Find a record by given identificator
	 *
	 * @param mix $id
	 * @return array
	 */
	public function byID($id);
}