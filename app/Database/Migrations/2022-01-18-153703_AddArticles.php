<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddArticles extends Migration
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
                'constraint' => '255'
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
            'author_id' => [
                'type' => 'INT',
                'constraint' => '5'
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => '5'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['publish', 'draft'],
                'default' => 'draft'
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('articles');
	}

	public function down()
	{
		$this->forge->dropTable('articles');
	}
}
