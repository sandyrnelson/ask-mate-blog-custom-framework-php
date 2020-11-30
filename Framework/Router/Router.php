<?php


namespace BK_Framework\Router;


/**
 * Class Router
 *
 * Router plays a key role in elegant routing implemented in BK-Framework.
 *
 * Example of usage:
 *
 * When routing is used, the application should be set to redirect all requests to a
 * single index.php file. After each request all endpoints should be converted
 * to an instance of Route and be registered by class Router.
 *
 * The mentioned index.php file parses the URL and calls execute() on Router which traverses
 * the available endpoints and calls the corresponding callback.
 *
 * Note: routing is an optional feature of BK-Framework, it is also possible to define several
 * public PHP-files and have them refer to each other.
 *
 * @package BK_Framework\Router
 */
class Router
{
	/**
	 * @var array Array of all currently available routes
	 */
	private static array $routes = array();

	/**
	 * Register a new endpoint with its corresponding method and callback function.
	 *
	 * @param string $endpoint Path to given endpoint eg. /names
	 * @param mixed $function Callback which is called upon visiting the endpoint
	 * @param string $method Request method eg. GET, POST etc.
	 */
	public static function add(string $endpoint, $function, string $method)
	{
		array_push(self::$routes, new Route($endpoint, $function, $method));
	}

	/**
	 * Execute a callback based on the path and method provided.
	 *
	 * Traverses all available endpoints and in case of matching paths and methods
	 * executes the corresponding callback.
	 *
	 * @param string $endpoint Path visited
	 * @param string $method Request method
	 */
	public static function execute(string $endpoint, string $method): void
	{

		$pathExists = false;

		foreach (self::$routes as $route) {

			$variables = array();

			if ($route->matchEndpoint($endpoint, $variables)) {

				if ($method == $route->getMethod()) {

					$route->execute($variables);
					return;

				} else $pathExists = true;
			}

		}

		// If path was found, but there was no match for the given method
		if ($pathExists) header("HTTP/1.0 405 Method Not Allowed");

		// If path cannot be found in the available routes
		else header("HTTP/1.0 404 Not Found");

	}
}
