<?php


namespace App\Controller;


use BK_Framework\Database\Connection\Connection;
use BK_Framework\Helper\File;
use BK_Framework\Helper\JSON;
use BK_Framework\Logger\Logger;
use BK_Framework\View\BladeView;
use BK_Framework\View\View;
use Exception;
use PDO;

abstract class BaseController
{

	protected static array $dbConfig;
	protected static View $view;

	/**
	 * BaseController constructor.
	 */
	public function __construct()
	{
		try{
			$this->configureApp();
		} catch (Exception $exception) {
			echo "Could not load configuration date";
		}
	}

	private function configureApp()
	{
		$configurationContent = File::read($this->getRootDirectory() . "Config/config.json");
		$config = JSON::decode($configurationContent);

		self::$dbConfig = $config["database_connection"];

		$templateInfo = $config["template_engine"];
		self::$view = new BladeView($templateInfo["templates"], $templateInfo["template-cache"]);

		$logInfo = $config["logging"];
		Logger::setLogDirectory($logInfo["log-directory"]);
		Logger::setLogFileExtension($logInfo["extension"]);
	}

	protected function getRootDirectory()
	{
		return __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
	}

	protected function getConnection() : PDO
	{
		return Connection::getConnection(self::$dbConfig);
	}

	public abstract function run();

	protected function view(string $template, array $variables) : void
	{
		self::$view->render($template, $variables);
	}

}
