<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBooks extends Migration
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
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => '5'
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'year' => [
                'type' => 'YEAR'
            ],
            'author' => [
                'type' => 'VARCHAR',
                'constraint' => '64'
            ],
            'publisher' => [
                'type' => 'VARCHAR',
                'constraint' => '64'
            ],
            'publication_year' => [
                'type' => 'YEAR'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Available', 'Not Available'],
                'default' => 'Not Available',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('books');
	}

	public function down()
	{
		$this->forge->dropTable('books');
	}
}
