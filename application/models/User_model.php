<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends MY_Model
{
	public $table = 'users';
	public $primary_key = 'id';

	public $fillable = [
		'name',
		'email',
		'hashed_password',
	];

	public function __construct()
	{
		$this->return_as = 'array';
		parent::__construct();
	}
}
