<?php


namespace BK_Framework\View;


/**
 * Class View
 *
 * Abstract class representing the view layer in MVC architecture
 *
 * @package BK_Framework\View
 */
abstract class View
{

	/**
	 * Display the given content $template after engineering $variables into the provided text
	 *
	 * @param string $template Name of the required template
	 * @param array $variables Associative array with all necessary variables
	 */
	public abstract function render(string $template, array $variables) : void;

}
