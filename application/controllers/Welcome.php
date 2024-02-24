<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Test $test
 **/
class Welcome extends CI_Controller
{
	public function index()
	{
		$this->load->database();
		$this->load->library('tests/test');
		$this->test->run();

		//$this->load->view('layouts/app', [
		//'content' => 'welcome_message',
		//'scripts' => [
		//'pages/welcome.js'
		//]
		//]);
	}
}
