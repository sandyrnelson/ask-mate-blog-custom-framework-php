<?php


namespace BK_Framework\SuperGlobal;


/**
 * Class Server
 *
 * Helper class for easy use of super-global variable $_SERVER
 *
 * @package BK_Framework\SuperGlobal
 */
class Server
{

	/**
	 * @return string
	 */
	public static function getPath() : string
	{
		return parse_url($_SERVER['REQUEST_URI'])["path"] ?? "/";
	}

	/**
	 * @return string
	 */
	public static function getMethod() : string
	{
		return $_SERVER['REQUEST_METHOD'];
	}

}
