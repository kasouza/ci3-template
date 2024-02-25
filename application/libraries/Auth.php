<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth
{
	protected $CI;

	protected $userdata = null;
	protected $userProfile = null;

	/** @var User_model $model */
	protected $model;

	public function __construct()
	{
		$this->CI = &get_instance();

		$this->CI->load->model('user_model');
		$this->model = $this->CI->user_model;

		$this->userdata = $this->CI->session->userdata();
	}

	public function is_logged_in()
	{
		return !empty($this->userdata['id']);
	}

	public function redirect_if_logged_in($to = '/')
	{
		if ($this->is_logged_in()) {
			redirect($to);
		}
	}

	public function get_userdata()
	{
		return $this->userdata;
	}

	public function reload_userdata()
	{
		if (!empty($this->userdata['id'])) {
			$user = $this->model->where('id', $this->userdata['id'])->get();
			if ($user !== false) {
				$this->userdata = $user;
				$this->CI->session->set_userdata($this->userdata);
			}
		}
	}
}
