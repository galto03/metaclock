<?php

namespace Mock;

require_once 'vendor/Mock/App.php';
require_once 'vendor/Mock/View.php';

class AppTest extends \PHPUnit_Framework_TestCase
{
	protected $app;

	protected $view;

	protected function setUp()
	{
		$this->view = new View;

		$this->app = new App($this->view, 'Mock');

		set_error_handler(array($this->app, 'error'), E_ALL | E_STRICT);

		spl_autoload_register(array($this->app, 'autoload'));

		date_default_timezone_set('UTC');
	}

	function testDispatchController()
	{
		$this->assertEquals($this->app->dispatchController(), $this->app);
	}

	function testServe()
	{
		$this->view->name = 'index';

		$this->assertEquals($this->app->serve(), $this->app);
	}

	function testLoadPlugins()
	{
		$this->assertEquals($this->app->loadPlugins(), $this->app);
	}

	function testSetGetConfig()
	{
		$this->assertEquals($this->app->setConfig('key', 'value'), $this->app);
		$this->assertEquals($this->app->getConfig('key'), 'value');
	}

	function testGetModel()
	{
		$this->assertTrue($this->app->getModel('mock') instanceof \Swiftlet\Interfaces\Model);
	}

	function testGetLibary()
	{
		$this->assertTrue($this->app->getLibrary('mock') instanceof \Swiftlet\Interfaces\Library);
	}

	function testRegisterHook()
	{
		$this->assertEquals($this->app->registerHook('test', new Controllers\Index, new View), $this->app);
	}

	/**
	 * @expectedException \ErrorException
	 */
	function testError()
	{
		$this->app->error(null, null, null, null);
	}
}
