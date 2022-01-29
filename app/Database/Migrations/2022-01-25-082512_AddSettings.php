<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSettings extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'site_name' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'site_description' => [
				'type' => 'TEXT',
				'null' => true
			],
			'site_logo' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => true
			],
			'facebook_link' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'twitter_link' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true
			],
			'instagram_link' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true
			],
			'github_link' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true
			]
		]);

		$this->forge->createTable('settings');
	}

	public function down()
	{
		$this->forge->dropTable('settings');
	}
}
