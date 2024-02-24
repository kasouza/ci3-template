<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Unit $unit
 **/
class MY_Test_suite
{
	protected $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->library('unit_test');
		$this->unit = $this->CI->unit;
		$this->unit->use_strict(true);
	}

	public function run()
	{
		$methods = get_class_methods($this);
		foreach ($methods as $method) {
			if (substr($method, 0, 4) == 'test') {
				call_user_func([$this, $method]);
			}
		}
	}

	public function assert($test, $expected = true, $notes = null)
	{
		$backtrace = debug_backtrace();

		$caller_backtrace = $backtrace[1];

		$test_name_parts = [];
		$test_name_parts[] = isset($caller_backtrace['class']) ? $caller_backtrace['class'] : '';
		$test_name_parts[] = isset($caller_backtrace['function']) ? $caller_backtrace['function'] : '';

		$test_name = implode('::', $test_name_parts);

		$this->unit->run(
			$test,
			$expected,
			$test_name,
			$notes,
			2 // Skip this function on the backtrace, showing the proper line number, file etc in the report
		);
	}
}
