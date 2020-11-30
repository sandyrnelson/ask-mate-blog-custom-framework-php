<?php


namespace BK_Framework\Database\QueryTools;


/**
 * Class ResultSet
 *
 * Class is utilized for storing all data returned from database
 * operations in a uniform way.
 *
 * @package BK_Framework\Database\QueryTools
 */
class ResultSet
{

	/**
	 * The record to which this instance of ResultSet corresponds.
	 * Keys in this associative array are those that are obtained from the query result.
	 * @var array
	 */
	private array $record;

	/**
	 * ResultSet constructor.
	 * @param array $record
	 */
	public function __construct(array $record)
	{
		$this->record = $record;
	}

	/**
	 * Returns if given attribute is present in ResultSet
	 *
	 * @param string $property
	 * @return bool
	 */
	public function has(string $property)
	{
		return array_key_exists($property, $this->record);
	}

	/**
	 * Return the value of the given attribute or null if not present
	 *
	 * @param string $property
	 * @return mixed|null
	 */
	public function get(string $property)
	{
		return $this->record[$property] ?? null;
	}

	/**
	 * Sets a new value for the given attribute in the ResultSet.
	 * If attribute is not present method has no effect.
	 *
	 * @param string $property
	 * @param $value
	 */
	public function set(string $property, $value) : void
	{
		if ($this->has($property)) $this->record[$property] = $value;
	}


}
