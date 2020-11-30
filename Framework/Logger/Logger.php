<?php


namespace BK_Framework\Logger;


use BK_Framework\Helper\File;
use Psr\Log\LoggerInterface;

/**
 * Class Logger
 *
 * Generic logger for logging information about application-related events
 *
 * @package BK_Framework\Logger
 */
class Logger implements LoggerInterface
{

	/**
	 * Class logger follows singleton design pattern. This is the one and only instance
	 * which can be created thereof.
	 *
	 * @var Logger|null
	 */
	private static ?Logger $logger = null;

	/**
	 * @var string Names of the folder where log-files are stored. Must be set externally.
	 */
	private static string $logDirectory;

	/**
	 * @var string The concatenated relative path to the directory of log-files
	 */
	private static string $pathToLogFiles = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Log" . DIRECTORY_SEPARATOR;

	/**
	 * @var string Extension of log-files. Must be set externally.
	 */
	private static string $logFileExtension;

	/**
	 * Logger constructor.
	 */
	private function __construct() {}

	/**
	 * @return Logger|null
	 */
	public static function getInstance()
	{
		if (!self::$logger) self::$logger = new Logger();
		return self::$logger;
	}

	/**
     * @inheritDoc
     */
    public function emergency($message, array $context = array())
    {
		$this->saveLogMessage($message, __FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function alert($message, array $context = array())
    {
		$this->saveLogMessage($message, __FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function critical($message, array $context = array())
    {
		$this->saveLogMessage($message, __FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function error($message, array $context = array())
    {
		$this->saveLogMessage($message, __FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function warning($message, array $context = array())
    {
		$this->saveLogMessage($message, __FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function notice($message, array $context = array())
    {
		$this->saveLogMessage($message, __FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function info($message, array $context = array())
    {
		$this->saveLogMessage($message, __FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function debug($message, array $context = array())
    {
		$this->saveLogMessage($message, __FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = array())
    {
		$this->saveLogMessage($message, $level);
    }


	/**
	 * Generate uniform log message with timestamp and log-level, finally save it
	 * to external file
	 *
	 * @param string $message
	 * @param string $logLevel
	 */
	private function saveLogMessage(string $message, string $logLevel) : void
	{
		$logFile = self::$pathToLogFiles . $logLevel . self::$logFileExtension;
		$text = strtoupper($logLevel) . " " . date('Y-m-d H:i:s') . " " . $message;
		File::append($logFile, $text, true);
	}

	/**
	 * @param string $logDirectory
	 */
	public static function setLogDirectory(string $logDirectory): void
	{
		self::$logDirectory = $logDirectory;
	}

	/**
	 * @param string $logFileExtension
	 */
	public static function setLogFileExtension(string $logFileExtension): void
	{
		self::$logFileExtension = $logFileExtension;
	}


}
