<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Form_validation $form_validation
 * @property Users_service 		$users_service
 **/
class Users extends MY_Controller
{
	public function register()
	{
		$this->auth->redirect_if_logged_in();

		$this->load->helper('form');
		$this->load->view('layouts/app', [
			'content' => 'users/register',
		]);
	}

	public function register_post_validate()
	{
		$this->auth->redirect_if_logged_in();

		$this->load->database();
		$this->load->library('form_validation');

		$this->form_validation->set_rules(
			'name',
			'Nome',
			'errors:quired|min_length[5]|max_length[255]'
		);

		$this->form_validation->set_rules('password', 'Senha', 'trim|required');
		$this->form_validation->set_rules('passconf', 'Confirmação de Senha', 'trim|required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', [
			'is_unique' => 'Esse %s já existe',
		]);

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('layouts/app', [
				'content' => 'users/register',
			]);
			return false;
		}

		return true;
	}

	public function register_post()
	{
		$this->load_service('users_service');
		$user_id = $this->users_service->register(
			$this->input->post('name'),
			$this->input->post('email'),
			$this->input->post('password')
		);

		if (false === $user_id) {
			$this->load->view('layouts/app', [
				'content' => 'users/register',
				'errors' => $this->users_service->get_and_clear_errors(),
			]);

			return;
		}

		$this->load->view('layouts/app', [
			'content' => 'users/register_success'
		]);
	}

	public function login()
	{
		$this->auth->redirect_if_logged_in();

		$this->load->helper('form');
		$this->load->view('layouts/app', [
			'content' => 'users/login',
		]);
	}

	public function login_post_validate()
	{
		$this->auth->redirect_if_logged_in();

		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Senha', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('layouts/app', [
				'content' => 'users/login',
			]);
			return false;
		}

		return true;
	}

	public function login_post()
	{
		$this->load_service('users_service');
		$user = $this->users_service->login(
			$this->input->post('email'),
			$this->input->post('password')
		);

		if (false === $user) {
			$this->load->view('layouts/app', [
				'content' => 'users/login',
				'errors' => $this->users_service->get_and_clear_errors(),
			]);

			return;
		}

		$this->load->view('layouts/app', [
			'content' => 'users/register_success'
		]);
	}
}
