<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_Input input
 **/
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function _remap($method, $args)
	{
		$http_method = strtolower($this->input->server('REQUEST_METHOD'));
		if (method_exists($this, $method . '_' . $http_method)) {
			call_user_func([$this, $method . '_' . $http_method], ...$args);
		} else if (method_exists($this, $method)) {
			call_user_func([$this, $method], ...$args);
		} else {
			show_404();
		}
	}
}
