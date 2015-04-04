<?php

namespace HelloWorld\Controllers;

/**
 * Index controller
 */
class Clock extends \Swiftlet\Abstracts\Controller
{
	/**
	 * Page title
	 * @var string
	 */
	protected $title = 'Alarm Clock';

	/**
	 * Default action
	 * @param $args array
	 */
	public function index(array $args = array())
	{
		// Create a model instance, see /HelloWorld/Models/Example.php
		$example = $this->app->getModel('example');

		// Get some data from the model and pass it to the view to display it
		//$this->view->helloWorld = $example->getHelloWorld();
	}
}
