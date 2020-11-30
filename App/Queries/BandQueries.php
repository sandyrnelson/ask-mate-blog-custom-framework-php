<?php


namespace App\Queries;


use BK_Framework\Database\QueryTools\Queries;
use BK_Framework\Database\QueryTools\ResultSet;
use PDO;

class BandQueries
{

	public static function getAll(PDO $pdo) : array
	{
		$sql = "SELECT id, founded, name, country, genre
				FROM bands";
		return Queries::queryAll($pdo, $sql);
	}

	public static function getBy(PDO $pdo, int $id) : ResultSet
	{
		$sql = "SELECT id, founded, name, country, genre
				FROM bands
				WHERE id = :id";
		return Queries::queryOne($pdo, $sql, ["id"=>$id]);
	}

	public static function addSimple(PDO $pdo, string $name) : string
	{
		$sql = "INSERT INTO bands (name)
				VALUES (:name)";
		return Queries::executeAndReturnWithId($pdo, $sql, ["name"=>$name]);
	}
}
