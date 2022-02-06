<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPortfolios extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
			'title VARCHAR(255) NOT NULL UNIQUE',
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => true
            ],
			'cover' => [
                'type' => 'VARCHAR',
				'constraint' => '128',
                'null' => true
            ],
			'date' => [
				'type' => 'DATE',
				'null' => true,
			]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('portfolios');
	}

	public function down()
	{
		$this->forge->dropTable('portfolios');
	}
}
