<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__ . '/MY_Test_suite.php';

foreach (glob(__DIR__ . "/*test_suite.php") as $filename) {
	include $filename;
	$basename = pathinfo($filename, PATHINFO_BASENAME);
}

/**
 * @property CI_Unit $unit
 **/
class Test
{
	protected $CI;

	/**
	 * @var MY_Test_suite[]
	 */
	protected $test_suites = [];

	public function __construct()
	{
		if (ENVIRONMENT === 'production') {
			show_error('Tests disabled in production environment');
		}

		$this->CI = &get_instance();
		$this->CI->load->library('unit_test');
		$this->unit = $this->CI->unit;

		// Clunky self registering tests or whatever
		foreach (glob(__DIR__ . "/*test_suite.php") as $filename) {
			$basename = pathinfo($filename, PATHINFO_FILENAME);
			if (!class_exists($basename)) {
				exit('No class for test ' . $filename);
			}

			$this->register(new $basename);
		}
	}

	/**
	 * @param MY_Test_suite $test_suite
	 */
	public function register($test_suite)
	{
		$this->test_suites[] = $test_suite;
	}

	public function run()
	{
		foreach ($this->test_suites as $test_suite) {
			$test_suite->run();
		}

		echo $this->unit->report();
	}
}
