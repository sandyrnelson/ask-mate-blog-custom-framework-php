<?php


namespace BK_Framework\Database\Connection;
use BK_Framework\Database\QueryTools\FrameworkPDO;
use \PDO;


/**
 * Class Connection
 *
 * Connection class iss responsible for creating a new instance of FrameworkPDO
 * from the provided connection data
 *
 * @package BK_Framework\Database\Connection
 */
class Connection
{

	/**
	 * Creates a new instance of FrameworkPDO from the given array
	 *
	 * @param array $config Stores connection data in an associative array. Must
	 * contain keys "user", "password", "host" and "database_name"
	 * @return PDO
	 */
	public static function getConnection(array $config) : PDO
	{
		$user = $config["user"];
		$password = $config["password"];
		$host =  $config["host"];
		$db =  $config["database_name"];

		return new FrameworkPDO($user, $password, $host, $db);
	}

}
