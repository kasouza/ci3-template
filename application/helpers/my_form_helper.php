<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('error_class')) {

	/**
	 * Form Error
	 *
	 * Returns $error_class ('error' by default) if a field has errors,
	 * returning an empty string otherwise.
	 *
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	function error_class($field = '', $prefix = '', $suffix = '', $error_class = 'error')
	{
		return has_error($field, $prefix, $suffix) ? $error_class : '';
	}
}

if (!function_exists('has_error')) {

	/**
	 * Form Error
	 *
	 * Returns if a field has errors.
	 *
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	boolean
	 */
	function has_error($field = '', $prefix = '', $suffix = '')
	{
		return !empty(form_error($field, $prefix, $suffix));
	}
}
