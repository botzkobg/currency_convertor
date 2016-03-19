<?php

namespace Libs\Source;

/**
 * Class CSVFile
 *
 * @package Libs\Source
 */
class CSVFile extends File {
	/**
	 * Array with all the data
	 *
	 * The key of the array is the currency code
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * CSVFile constructor.
	 *
	 * @param string $file_name
	 */
	public function __construct($file_name) {
		parent::__construct($file_name);

		//TODO: in our case move this in byID and directly search in the file. If this program will be used in cycle the this is better
		while (($row = fgetcsv($this->handle, 1000, ',')) !== false) {
			if (isset($this->data[$row[0]])) {
				user_error("WRN-0001: Currency {$row[0]} already loaded ! First record will be in use !", E_USER_WARNING);
				continue;
			}

			$this->data[$row[0]] = array(
				'Code' => $row[0],
				'Name' => $row[0],
				'Course' => $row[1],
			);
		}
	}

	/**
	 * Find a record by given ID
	 *
	 * Find a record by given identificator
	 *
	 * @param mix $id
	 * @return array
	 * @throws \Exception
	 */
	public function byID($id)
	{
		if (isset($this->data[$id]))
			return $this->data[$id];

		throw new \Exception("ERR-0003: Record with ID '{$id}' not found !");
	}
}