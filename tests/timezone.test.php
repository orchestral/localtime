<?php

Bundle::start('orchestra');
Bundle::start('localtime');

class TimezoneTest extends Localtime\Testable\TestCase {
	
	/**
	 * Test Localtime\Model\Timezone::lists()
	 *
	 * @test
	 */
	public function testTimezoneLists()
	{
		$list = Localtime\Model\Timezone::lists();

		$this->assertTrue(array_key_exists('UTC', $list));
		$this->assertTrue(array_key_exists('Asia/Kuala_Lumpur', $list));
	}
}