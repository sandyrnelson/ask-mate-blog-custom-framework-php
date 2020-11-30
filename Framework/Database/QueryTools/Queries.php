<?php


namespace BK_Framework\Database\QueryTools;


use PDO;

/**
 * Class Queries
 *
 * Queries plays a key role in abstracting away details of database-operation.
 * Consists of several methods, each corresponding to a common option of executing
 * SQL statements.
 *
 * @package BK_Framework\Database\QueryTools
 */
class Queries
{

	/**
	 * Execute SQL statements with multiple records returned. Returns result in the form
	 * of a ResultSet-array.
	 *
	 * @param PDO $pdo Usually a FrameworkPDO within BK-Framework
	 * @param string $sql SQL string corresponding to the desired query
	 * @param array $variables An associative array containing the variables to be
	 * place into the prepared statement
	 * @return array Consists ResultSet-type objects
	 */
	public static function queryAll(PDO $pdo, string $sql, array $variables = array()) : array
	{
		$stmt = $pdo->prepare($sql);
		$stmt->execute($variables);
		return $stmt->fetchAll();
	}

	/**
	 * Execute SQL statements with a single record returned. Returns result in the form
	 * of a ResultSet.
	 *
	 * @param PDO $pdo Usually a FrameworkPDO within BK-Framework
	 * @param string $sql SQL string corresponding to the desired query
	 * @param array $variables An associative array containing the variables to be
	 * place into the prepared statement
	 * @return ResultSet
	 */
	public static function queryOne(PDO $pdo, string $sql, array $variables = array()) : ResultSet
	{
		$stmt = $pdo->prepare($sql);
		$stmt->execute($variables);
		return $stmt->fetch();
	}

	/**
	 *
	 * Execute SQL-statements with no explicit return data. Returns the ID
	 * of the record instead.
	 *
	 * @param PDO $pdo Usually a FrameworkPDO within BK-Framework
	 * @param string $sql SQL string corresponding to the desired query
	 * @param array $variables An associative array containing the variables to be
	 * place into the prepared statement
	 * @return string The ID of the given record upon which the statement was executed
	 */
	public static function executeAndReturnWithId(PDO $pdo, string $sql, array $variables = array()) : string
	{
		$stmt = $pdo->prepare($sql);
		$stmt->execute($variables);
		return $pdo->lastInsertId();
	}

}
