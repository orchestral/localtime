<?php

Bundle::start('orchestra');
Bundle::start('localtime');

class RoutingAccountTest extends Localtime\Testable\TestCase {
	/**
	 * User instance.
	 *
	 * @var Orchestra\Model\User
	 */
	protected $user = null;

	/**
	 * Setup the test environment.
	 */
	public function setUp()
	{
		parent::setUp();
		Config::set('application.timezone', 'UTC');

		$this->user = Orchestra\Model\User::find(1);
	}

	/**
	 * Teardown the test environment.
	 */
	public function tearDown()
	{
		unset($this->user);

		parent::tearDown();
	}

	/**
	 * Test configuring user localtime.
	 *
	 * @test
	 */
	public function testConfigureUserLocaltime()
	{
		$this->be($this->user);
		$meta = Orchestra\Memory::make('user');

		$this->assertTrue(is_null($meta->get("timezone.1")));

		$response = $this->call("orchestra::account@index", array(), 'POST', array(
			'id'            => $this->user->id,
			'fullname'      => 'Foobar',
			'email'         => $this->user->email,
			"meta_timezone" => "Asia/Kuala_Lumpur",
		));

		$this->assertInstanceOf('Laravel\Redirect', $response);
		$this->assertEquals(handles('orchestra::account'), 
			$response->foundation->headers->get('location'));

		Orchestra\Core::shutdown();
		Orchestra\Core::start();

		$meta = Orchestra\Memory::make('user');
		$user = Orchestra\Model\User::find(1);
		$date = "2011-08-11 08:00:00";

		$this->assertEquals("Asia/Kuala_Lumpur", $meta->get("timezone.1"));
		$this->assertEquals("Asia/Kuala_Lumpur", $user->timezone());
		$this->assertEquals("2011-08-11 16:00:00", $user->localtime($date)->format('Y-m-d H:i:s'));
	}
}