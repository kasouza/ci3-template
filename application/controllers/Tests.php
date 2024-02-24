<?php

/**
 * @property Test $test
 **/
class Tests extends CI_Controller
{
	public function index()
	{
		$this->load->library('tests/test');
		$this->test->run();
	}
}
