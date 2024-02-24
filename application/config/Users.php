<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
	public function register()
	{
		$this->load->database();
		$this->load->view('layouts/app', [
			'content' => 'welcome_message',
			'scripts' => [
				'pages/welcome.js'
			]
		]);
	}
}
