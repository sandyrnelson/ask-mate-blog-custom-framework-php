<?php


namespace BK_Framework\SuperGlobal;


/**
 * Class Get
 *
 * Helper class for easy use of super-global variable $_GET
 *
 * @package BK_Framework\SuperGlobal
 */
class Get
{

	/**
	 * Obtain value associated with the provided key or null if key does not exist
	 *
	 * @param string $key
	 * @return string|null
	 */
	public static function get(string $key) : ?string
	{
		return $_GET[$key] ?? null;
	}

	/**
	 * Determine if provided key exists in query parameters
	 *
	 * @param string $key
	 * @return bool
	 */
	public static function has(string $key) : bool
	{
		return isset($_GET[$key]);
	}

	/**
	 * Returns all keys present in the query parameters
	 *
	 * @return array
	 */
	public static function keySet() : array
	{
		return array_keys($_GET);
	}

}
