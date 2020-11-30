<?php

namespace BK_Framework\Config;

/**
 * Class Scanner
 *
 * Helper class for ConfigGenerator to read data from the console
 *
 * @package BK_Framework\Config
 */
class Scanner
{

	/**
	 * @var string Space between prompt and user-input for better UX
	 */
	private string $spaces = "   ";

	/**
	 * Asks input from user until having a non-null string.
	 *
	 * @param string $prompt
	 * @return string
	 */
	public function askForNotEmptyUserInput(string $prompt) : string
	{
		while (true) {
			$input = readline($prompt.$this->spaces);
			if (0 < strlen($input)) break;
			else $this->print("Please enter a not-empty string");
		}
		return $input;
	}

	/**
	 * Reads user input once. User input is considered valid if it is non-empty.
	 * Otherwise the provided $default value is returned.
	 *
	 * @param string $prompt
	 * @param string $default
	 * @return string
	 */
	public function askForInputWithDefaultValues(string $prompt, string $default) : string
	{
		$input = readline($prompt.$this->spaces);
		if (0 == strlen($input)) $input = $default;
		return $input;
	}

	/**
	 * Echoes the given string followed by a new line
	 *
	 * @param $string
	 */
	public function print($string) {
		echo "$string\n";
	}

	/**
	 * Reads extension from the user. Input is considered valid if starts with a period.
	 * In case of empty input returns the $default value.
	 *
	 * @param string $prompt
	 * @param string $default
	 * @return string
	 */
	public function askForExtensionWithDefaultValue(string $prompt, string $default) : string
    {
		while (true) {
			$input = readline($prompt.$this->spaces);
			if (0 == strlen($input)) break;
			elseif ($input[0] !== ".") $this->print("Please enter a valid extension!");
			else return $input;
		}
		return $default;
    }

}
