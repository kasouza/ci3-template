<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Test $test
 **/
class Welcome extends MY_Controller
{
	public function index($id = null)
	{
		$this->load->view('layouts/app', [
			'content' => 'welcome_message',
			'scripts' => [
				'pages/welcome.js'
			]
		]);
	}
}
