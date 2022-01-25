<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPages extends Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pages');
	}

	public function down()
	{
		$this->forge->dropTable('pages');
	}
}
