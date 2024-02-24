<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends MY_Model
{
	protected $table = 'users';
	protected $primary_key = 'id';

	protected $fillable = [
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
