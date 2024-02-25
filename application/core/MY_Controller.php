<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_Input 	$input
 * @property CI_Output 	$output
 * @property Auth 		$auth
 **/
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Remaps the incoming requests
	 *
	 * Remaps the incoming request based on the request's HTTP Method:
	 *
	 * #Example
	 * For a given uri /users/do_something that matches the Users controller
	 *
	 * The following method will be called (based on the HTTP method)
	 *   - GET
	 *     - Users::do_something_get() 
	 *     - If the previous does not exist, Users::do_something()
	 *
	 *   - POST
	 *     - Users::do_something_post()
	 *
	 *   ...
	 *   The same for other HTTP methods
	 *
	 *  If a method with the same name but ending with '_validate' is present,
	 *  it is called before the final handler and must return a boolean that 
	 *  represents wheter or not the incoming request is valid. Additionally,
	 *  this validate method might want to render a view to the user presenting
	 *  the errors.
	 * 
	 */
	public function _remap($method, $args)
	{
		$http_method = strtolower($this->input->server('REQUEST_METHOD'));
		$method_to_call = '';

		if (method_exists($this, $method . '_' . $http_method)) {
			$method_to_call = $method . '_' . $http_method;
		} else if (method_exists($this, $method)) {
			$method_to_call = $method;
		}

		if (empty($method_to_call)) {
			$this->output->set_status_header(503);
			return;
		}

		$valid = true;
		if (method_exists($this, $method_to_call . '_validate')) {
			$valid = call_user_func([$this, $method_to_call . '_validate'], ...$args);
		}

		if ($valid) {
			call_user_func([$this, $method_to_call], ...$args);
		}
	}

	/**
	 * Loads a service
	 * @param string $library_name
	 * @param string|null $property_name (optional) Name of the property to set the service to
	 */
	public function load_service($service_name, $property_name = null)
	{
		$property_name = !empty($property_name) ? $property_name : $service_name;

		$this->load->library('services/' . $service_name, null, $property_name);
	}
}
