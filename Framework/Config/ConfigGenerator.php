<?php

namespace BK_Framework\Config;

require_once "../../vendor/autoload.php";

use BK_Framework\Helper\File;
use BK_Framework\Helper\JSON;
use Exception;

/**
 * Class ConfigGenerator
 *
 * This class is responsible for setting up projects written in BK-Framework.
 * By calling the run() method anywhere a short script runs which reads all
 * application specific settings and configurations into a single file. This file
 * later can be used anywhere within the application to gather data about database,
 * view and logging settings.
 *
 * @package BK_Framework\Config
 */
class ConfigGenerator
{
	/**
	 * @var Scanner Used for reading data from the user in the console
	 */
	private Scanner $scanner;
	/**
	 * The relative path to the directory where the configuration file will be stored.
	 * As a convention, all application-related data is stored inside an App directory
	 * within the root folder. In this directory we can place our config-file anywhere
	 * we would like to.
	 *
	 * @var string
	 */
	private string $configDirectory;
	/**
	 * @var string The filename of the created config-file
	 */
	private string $configFileName;

	/**
	 * @var string Root directory is two levels higher in the directory tree
	 */
	private string $pathToRootDirectory = ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;

	/**
	 * Config constructor.
	 */
	public function __construct()
	{
		$this->scanner = new Scanner();
	}

	/**
	 * Sets up project and saves configuration data given by the user into a single file.
	 *
	 * Creates App folder within root directory and also sets up directories for log files
	 * and templates.
	 *
	 */
	public function run()
	{
		$connection = $this->setDatabaseConnection();
		$templateData = $this->setTemplatePaths();
		$logData = $this->setLogPaths();
		$this->setConfigPath();

		$data = ["database_connection" => $connection,
				"template_engine" => $templateData,
				"logging"=>$logData];

		$this->saveData($data);
	}

	/**
	 * Reads all database-connection related data from the user and creates an
	 * associative array.
	 *
	 * Information required: user, password, host, database name
	 *
	 * @return array
	 */
	private function setDatabaseConnection(): array
	{
		$this->scanner->print("\nDATABASE CONNECTION PARAMETERS\n");
		$user = $this->scanner->askForNotEmptyUserInput("Enter username!");
		$password = $this->scanner->askForNotEmptyUserInput("Enter password!");
		$host = $this->scanner->askForNotEmptyUserInput("Enter host!");
		$db = $this->scanner->askForNotEmptyUserInput("Enter database name!");

		return ["user" => $user, "password" => $password, "host" => $host, "database_name" => $db];
	}

	/**
	 * Reads directory-names for storing templates and template-cache files.
	 * Also creates directories if they do not exist.
	 *
	 * @return array
	 */
	private function setTemplatePaths(): array
	{
		$this->scanner->print("\nTEMPLATE DIRECTORY PARAMETERS\n");

		$templates = $this->scanner->askForInputWithDefaultValues(
			"Enter path to folder of templates [Templates]",
			"Templates");
		File::createDirectoryIfNotExist($this->pathToRootDirectory . $templates);

		$templateCache = $this->scanner->askForInputWithDefaultValues(
			"Enter path to folder of cached templates [TemplateCache]!",
		"TemplateCache");
		File::createDirectoryIfNotExist($this->pathToRootDirectory . $templateCache);

		return ["templates" => $templates, "template-cache" => $templateCache];
	}

	/**
	 * Reads directory for storing log-files.
	 * Creates directory and necessary log-files if they do not exist.
	 *
	 * @return array
	 */
	private function setLogPaths(): array
	{
		$this->scanner->print("\nLOGGING PARAMETERS\n");

		$logDirectory = $this->scanner->askForInputWithDefaultValues(
			"Enter the name of Log-directory [Log]",
			"Log");
		$pathToLogFiles = $this->pathToRootDirectory . $logDirectory;

		File::createDirectoryIfNotExist($pathToLogFiles);

		$extension = $this->scanner->askForExtensionWithDefaultValue(
			"Enter the extension of log-files [.log]!",
			".log");

		$this->createLogFiles($pathToLogFiles, $extension);

		return ["log-directory" => $logDirectory, "extension" => $extension];
	}

	/**
	 * Read directory and filename for created configuration file from user.
	 * Stores the given data in $configDirectory and $configFileName fields.
	 */
	private function setConfigPath(): void
	{

		$this->scanner->print("\nCONFIG DIRECTORY PARAMETERS\n");

		$configDir = $this->scanner->askForInputWithDefaultValues(
			"Where to create config.jon within /App? [/Config]",
			"Config");

		$this->configDirectory = $this->pathToRootDirectory .
								"App" . DIRECTORY_SEPARATOR .
								$configDir . DIRECTORY_SEPARATOR;

		File::createDirectoryIfNotExist($this->configDirectory);
		$this->configFileName = $this->scanner->askForInputWithDefaultValues(
			"How would you name your config file? [config.json]",
			"config.json");

	}

	/**
	 * Converts the acquired data jo JSON-format and save it to the provided
	 * external file.
	 *
	 * @param array $data
	 */
	private function saveData(array $data): void
	{

		try {
			$jsonContent = JSON::encode($data);
			File::write($this->configDirectory . $this->configFileName, $jsonContent);
			$this->scanner->print("Configuration data saved into $this->configFileName");
		} catch (Exception $exception) {
			echo "An error occurred. Configuration data could not be saved";
		}

	}

	/**
	 * Creates log-files in the given directory defined by $path argument.
	 *
	 * The 8 log-levels provided: alert, critical, debug, emergency, error, info, notice, warning
	 *
	 * @param string $path
	 * @param string $extension
	 */
	private function createLogFiles(string $path, string $extension)
	{
		$levels = array("alert", "critical", "debug", "emergency", "error", "info", "notice", "warning");

		foreach ($levels as $level) {
			File::createFileIfNotExist($path, $level . $extension);
		}

	}

}
