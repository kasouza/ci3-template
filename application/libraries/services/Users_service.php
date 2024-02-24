<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__ . '/MY_Service.php';

class Users_service extends MY_Service
{
	protected $model_name = 'user_model';

	/**
     * @param string $name
     * @param string $email
     * @param string $password
     */
	public function register($name, $email, $password)
	{
	}
}
