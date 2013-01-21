<?php namespace Localtime\Testable;

use Orchestra\Extension,
	Orchestra\Testable\Application as A;

class Application extends A {
	
	/**
	 * Construct a new application
	 *
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		Extension::detect();
		Extension::activate('localtime');
	}

	/**
	 * Remove application.
	 *
	 * @access public
	 * @return void
	 */
	public function remove()
	{
		Extension::deactivate('localtime');

		parent::remove();
	}
}