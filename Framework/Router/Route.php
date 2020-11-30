<?php


namespace BK_Framework\Router;


/**
 * Class Route
 *
 * Route class is responsible for storing associated data for a given endpoint
 * of our web-application. After each request all endpoints should be converted
 * to an instance of Route and be registered by class Router.
 *
 *
 *
 * @package BK_Framework\Router
 */
class Route
{

	/**
	 * @var array
	 */
	private array $routeData = array();

	/**
	 * Route constructor.
	 * @param string $endpoint
	 * @param $function
	 * @param string $method
	 */
	public function __construct(string $endpoint, $function, string $method)
	{
		$this->routeData["endpoint"] = $endpoint;
		$this->routeData["function"] = $function;
		$this->routeData["method"] = $method;
	}

	/**
	 * @return string
	 */
	public function getEndpoint() : string
	{
		return $this->routeData["endpoint"];
	}

	/**
	 * @param string $endpoint
	 * @param array $variableContainer
	 * @return bool
	 */
	public function matchEndpoint(string $endpoint, array &$variableContainer) : bool
	{

		if (substr_count($this->getEndpoint(), "/") !== substr_count($endpoint, "/")) return false;

		$searchRegexp = "/^" . str_replace("/", "\\/", $this->getEndpoint()) . "$/";
		$found = preg_match($searchRegexp, $endpoint, $variableContainer);
		array_shift($variableContainer );
		return $found;
	}

	/**
	 * @return string
	 */
	public function getMethod() : string
	{
		return $this->routeData["method"];
	}

	/**
	 * @param $variables
	 */
	public function execute($variables) : void
	{
		call_user_func($this->routeData["function"], ...$variables);
	}

}
