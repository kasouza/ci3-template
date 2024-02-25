<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Service
{
	/** 
	 * Model to be loaded by default 
	 * @var string
	 **/
	protected $model_name;

	protected $CI;
	protected $model;

	protected $errors = [];

	/**
	 * @param string $model
	 */
	public function __construct()
	{
		$this->CI = &get_instance();

		if (isset($this->model_name)) {
			$this->load_model($this->model_name, 'model');
		}
	}

	/**
	 * Loads a model
	 * @param string $model_name
	 * @param string|null $property_name (optional) Name of the property to set the model to
	 */
	public function load_model($model_name, $property_name = null)
	{
		$property_name = !empty($property_name) ? $property_name : $model_name;

		$this->CI->load->model($model_name);
		$this->{$property_name} = $this->CI->{$model_name};
	}

	/**
	 * Loads a library
	 *
	 * A service is just a library under the libraries/services/ directory
	 * 
	 * @param string $library_name
	 * @param string|null $property_name (optional) Name of the property to set the library to

	 */
	public function load_library($library_name, $property_name = null)
	{
		$property_name = !empty($property_name) ? $property_name : $library_name;

		$this->CI->load->library($library_name);
		$this->{$property_name} = $this->CI->{$library_name};
	}

	/**
	 * Loads a service
	 * @param string $library_name
	 * @param string|null $property_name (optional) Name of the property to set the service to
	 */
	public function load_service($service_name, $property_name = null)
	{
		$property_name = !empty($property_name) ? $property_name : $service_name;

		$this->CI->load->library('services/' . $service_name);
		$this->{$property_name} = $this->CI->{$service_name};
	}


	/**
	 * @param string $message Error messae
	 * @param int $code (optional) Error code, defaults to -1
	 */
	protected function add_error($message, $code = -1)
	{
		$this->errors[] = [
			'message' => $message,
			'code' => $code,
		];
	}

	/**
	 * Returns an array with all the errors.
	 *
	 * Empty array if no error happened.
	 *
	 * @return array
	 */
	public function get_errors()
	{
		return $this->errors;
	}

	/**
	 * Returns an array with all the errors. This function clears the errors.
	 *
	 * Empty array if no error happened.
	 *
	 * @return array
	 */
	public function get_and_clear_errors()
	{
		$errors = $this->errors;
		$this->errors = [];

		return $errors;
	}

	/**
	 * Returns the last error (if any) and remove it from the errors array.
	 *
	 * @return array|null
	 */
	public function pop_error()
	{
		if (0 === count($this->errors)) {
			return null;
		}

		$idx = count($this->errors) - 1;
		$last_error = $this->errors[$idx];
		unset($this->errors[$idx]);

		return $last_error;
	}
}
