<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__ . '/MY_Service.php';

/**
 * @property User_model $model
 **/
class Users_service extends MY_Service
{
	protected $model_name = 'user_model';

	/**
	 * @param string $name
	 * @param string $email
	 * @param string $password
	 * @return int|false
	 */
	public function register($name, $email, $password)
	{
		$id = $this->model->insert([
			'name' => $name,
			'email' => $email,
			'hashed_password' => password_hash($password, PASSWORD_DEFAULT),
		]);

		if (false === $id) {
			$this->add_error('Could not register user');
			return false;
		}

		return $id;
	}

	/**
	 * @param string $password
	 * @param string $email
	 * @return array|false
	 */
	public function login($email, $password)
	{
		$this->add_error('Saske');
		return false;

		$user = $this->model->where([
			'email' => $email,
		])->get();

		if (false === $user) {
			$this->add_error('Invalid email or password');
			return false;
		}

		if (false === password_verify($password, $user['hashed_password'])) {
			return false;
		}

		$this->CI->load->library('session');
		$this->CI->session->set_userdata($user);

		return $user;
	}
}
