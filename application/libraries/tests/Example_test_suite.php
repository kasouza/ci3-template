<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Example_test_suite extends MY_Test_suite
{
	public function test_example()
	{
		$this->assert('saske', 'saske');
	}
}
