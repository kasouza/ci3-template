<?php

defined('BASEPATH') or exit('Direct script access not allowed');

if (!function_exists('query_or_die')) {
	/**
	 * Runs a query and exits on failure.
	 *
	 * Usefull to not update the current migration version in the database if a 
	 * migration fails.
	 *
	 * #Example
	 * 	$this->query_or_die("CREATE TABLE example (...)");
	 *
	 * @param boolean $success
	 */
	function query_or_die($query, $params = [])
	{
		migrate_or_die(get_instance()->db->query($query, $params));
	}
}

if (!function_exists('migrate_or_die')) {
	/**
	 * Shows db error and exits if $success is false
	 *
	 * Usefull to not update the current migration version in the database if a 
	 * migration fails.
	 *
	 * #Example
	 * 	$this->or_die($this->dbforge->create_table(...));
	 *
	 * @param boolean $success
	 */
	function migrate_or_die($success)
	{
		if (false === $success) {
			$error = get_instance()->db->error();
			show_error($error['message'], $error['code']);
			die();
		}
	}
}
