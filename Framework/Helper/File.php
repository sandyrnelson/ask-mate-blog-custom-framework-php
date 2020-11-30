<?php


namespace BK_Framework\Helper;


/**
 * Class File
 *
 * Helper class for different operations in the filesystem
 *
 * @package BK_Framework\Helper
 */
class File
{

	/**
	 * Append text to a file (does not erase the content before writing)
	 *
	 * @param string $path
	 * @param string $content
	 * @param bool $breakLine
	 */
	public static function append(string $path, string $content, bool $breakLine = false): void
	{
		$file = fopen($path, "a");
		fwrite($file, $content);
		if ($breakLine) fwrite($file, PHP_EOL);
		fclose($file);
	}

	/**
	 * Overwrite content of file (erase content before writing)
	 *
	 * @param string $path
	 * @param string $content
	 * @param bool $breakLine
	 */
	public static function write(string $path, string $content, bool $breakLine = false): void
	{
		$file = fopen($path, "w");
		fwrite($file, $content);
		if ($breakLine) fwrite($file, PHP_EOL);
		fclose($file);
	}

	/**
	 * Read content of file
	 *
	 * @param string $path
	 * @return string
	 */
	public static function read(string $path): string
	{
		return file_get_contents($path);
	}

	/**
	 * Attempts to create a file if it does not exist
	 *
	 * @param string $path
	 * @param string $name
	 */
	public static function createFileIfNotExist(string $path, string $name) : void
	{
		$file = fopen($path . DIRECTORY_SEPARATOR . $name, "a");
		fclose($file);
	}

	/**
	 * Creates directory in filesystem if it does not exist.
	 * Creation of nested directories is also allowed. Widest permission is provided
	 * for the created directory.
	 *
	 * @param string $directory
	 */
	public static function createDirectoryIfNotExist(string $directory) : void
	{

		if(!is_dir($directory)){
			mkdir($directory, 0777,true);
		}

	}

}
