<?php


namespace BK_Framework\Helper;


/**
 * Class JSON
 *
 * Helper class for reading/writing JSON formatted data
 *
 * @package BK_Framework\Helper
 */
class JSON
{

	/**
	 * Encode a given string to JSON format
	 *
	 * @param array $data
	 * @return string
	 */
	public static function encode(array $data) : string
	{
		return json_encode($data);
	}

	/**
	 * Create associative array from string containing JSON-formatted data
	 *
	 * @param string $data
	 * @return array
	 */
	public static function decode(string $data) : array
	{
		return json_decode($data, true);
	}

}
