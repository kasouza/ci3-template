<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('show_errors')) {
	function show_errors($errors)
	{
		if (!empty($errors)) {
			echo '<ul class="errors-container">';

			foreach ($errors as $error) {
				$error_message = '';
				if (is_string($error)) {
					$error_message = $error;
				} else if (is_array($error) && isset($error['message'])) {
					$error_message = $error['message'];
				}

				echo '<li class="error">';
				echo $error_message;
				echo '</li>';
			}

			echo '</ul>';
		}
	}
}
