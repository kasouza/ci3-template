<?php defined('BASEPATH') or exit('Direct script access not allowed');

class Migration_Create_users_table extends CI_Migration
{
	public function __construct()
	{
		$this->load->helper('migration');
	}

	public function up()
	{
		query_or_die("
			CREATE TABLE users (
				id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,

				name 			VARCHAR(255) NOT NULL,
				email 			VARCHAR(255) NOT NULL UNIQUE,
				hashed_password VARCHAR(255) NOT NULL,

				role 			ENUM('admin', 'user') NOT NULL,

				created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
				updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP()
			);
		");
	}

	public function down()
	{
		query_or_die("
			DROP TABLE users;
		");
	}
}
