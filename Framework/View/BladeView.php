<?php


namespace BK_Framework\View;


use BK_Framework\Exception\BladeOneRenderingException;
use BK_Framework\Logger\Logger;
use eftec\bladeone\BladeOne;
use Exception;

/**
 * Class BladeView
 *
 * Responsible for rendering content by utilizing BladeOne template engine.
 * For details about the usage of BladeOne see https://www.larablocks.com/package/eftec/bladeone
 *
 * @package BK_Framework\View
 */
class BladeView extends View
{

	/**
	 * @var BladeOne Object used for rendering content
	 */
	private BladeOne $blade;

	/**
	 * BladeView constructor.
	 *
	 * @param string $templatesPath Path to template folder relative to root directory
	 * @param string $cachePath Path to template-cache folder relative to root directory
	 */
	public function __construct(string $templatesPath, string $cachePath)
	{
		$this->blade = new BladeOne($templatesPath, $cachePath, BladeOne::MODE_DEBUG);
	}

	/**
	 * Render the provided template using the given set of variables and echo it to the client
	 *
	 * @param string $template
	 *
	 * The name of the desired .blade.php file within the $templatesPath directory.
	 * Eg. for "search" for search.blade.php
	 *
	 * @param array $variables
	 * @throws BladeOneRenderingException When rendering results in failure
	 */
	public function render(string $template, array $variables): void
	{
		try {
			echo $this->blade->run($template, $variables);
		} catch (Exception $e) {
			$message = "Template $template could not be rendered";
			Logger::getInstance()->error($message);
			throw new BladeOneRenderingException($message);
		}
	}
}
