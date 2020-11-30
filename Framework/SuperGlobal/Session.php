<?php


namespace BK_Framework\SuperGlobal;


use BK_Framework\Exception\NoSessionException;
use BK_Framework\Logger\Logger;

/**
 * Class Session
 *
 * Helper class for easy use of super-global variable $_SESSION
 *
 * @package BK_Framework\SuperGlobal
 */
class Session
{

	/**
	 * Login user by setting value to "userId" key in session
	 *
	 * @param $id
	 * @throws NoSessionException If session_start() has not been called before operation
	 */
	public static function login($id) : void
	{
		self::checkSession("Could not log in. Session has not been initialized");
		$_SESSION["userId"] = $id;
	}

	/**
	 * Logout user by unsetting value to "userId" key in session
	 *
	 * @throws NoSessionException If session_start() has not been called before operation
	 */
	public static function logout() : void
	{
		self::checkSession("Could not log out. Session has not been initialized");
		session_unset();
	}

	/**
	 * Determine if user is logged in based on the presence of "userId" key in session
	 *
	 * @return bool
	 * @throws NoSessionException If session_start() has not been called before operation
	 */
	public static function isLoggedIn() : bool
	{
		self::checkSession("Logged in state could not be checked. Session has not been initialized");
		return isset($_SESSION["userId"]);
	}

	/**
	 * Determine if provided key exists in session
	 *
	 * @param string $key
	 * @return bool
	 * @throws NoSessionException If session_start() has not been called before operation
	 */
	public static function has(string $key) : bool
	{
		self::checkSession("Session variable $key could not be checked if set. Session has not been initialized");
		return isset($_SESSION[$key]);
	}

	/**
	 * Insert new key-value pair into session or change value associated with $key to $value
	 *
	 * @param string $key
	 * @param string $value
	 * @throws NoSessionException If session_start() has not been called before operation
	 */
	public static function set(string $key, string $value)
	{
		self::checkSession("Session variable $key could not be set. Session has not been initialized");
		$_SESSION[$key] = $value;
	}

	/**
	 * Remove key from session
	 *
	 * @param string $key
	 * @throws NoSessionException If session_start() has not been called before operation
	 */
	public static function unset(string $key)
	{
		self::checkSession("Session variable $key could not be unset. Session has not been initialized");
		unset($_SESSION[$key]);
	}

	/**
	 * Obtain value associated with the provided key or null if key does not exist
	 *
	 * @param string $key
	 * @return string|null
	 * @throws NoSessionException If session_start() has not been called before operation
	 */
	public static function get(string $key) : ?string
	{
		self::checkSession("Session variable $key could not be accessed. Session has not been initialized");
		return $_SESSION[$key] ?? null;
	}

	/**
	 * Determine if session_start() has been called, thus operating on $_SESSION array is permanent
	 *
	 * @param string $message
	 * @throws NoSessionException If session_start() has not been called before operation
	 */
	private static function checkSession(string $message) : void
	{
		if (session_status() === PHP_SESSION_NONE) {
			Logger::getInstance()->alert($message);
			throw new NoSessionException($message);
		}
	}

}
