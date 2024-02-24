<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
	public function index()
	{
	}

	public function register()
	{
		if ($this->input->server('REQUEST_METHOD') === 'GET') {
			$this->load->view('layouts/app', [
				'content' => 'users/register',
			]);

			return;
		}
	}

	public function register_post()
	{
		echo "HI LORENA";
	}
}
