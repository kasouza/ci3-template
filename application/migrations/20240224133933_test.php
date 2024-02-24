<?php defined('BASEPATH') or exit('Direct script access not allowed');

class Migration_Test extends CI_Migration
{
	public function __construct()
	{
		$this->load->helper('migration');
	}

	public function up()
	{
		query_or_die('CREATE TABLE DSADD """DSADNM');
	}
}
