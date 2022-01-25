<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategories extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');
	}

	public function down()
	{
		$this->forge->dropTable('categories');
	}
}
