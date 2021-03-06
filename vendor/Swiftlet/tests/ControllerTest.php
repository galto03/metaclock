<?php

namespace Mock;

require_once 'vendor/Mock/App.php';
require_once 'vendor/Mock/View.php';

class ControllerTest extends \PHPUnit_Framework_TestCase
{
	protected $controller;

	protected $view;

	protected function setUp()
	{
		$this->view       = new View;
		$this->controller = new Controllers\Index;
	}

	public function testSetApp()
	{
		$app = new App($this->view, 'Mock');

		$this->assertEquals($this->controller->setApp($app), $this->controller);
	}

	public function testSetView()
	{
		$this->assertEquals($this->controller->setView($this->view), $this->controller);
	}

	public function testSetTitle()
	{
		$this->controller->setView($this->view);

		$this->assertEquals($this->controller->setTitle('title'), $this->controller);
	}
}
