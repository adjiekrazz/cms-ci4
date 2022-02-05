<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriesSeeder extends Seeder
{
	public function run()
	{
		$categories = [
			[
				'name' => 'Tutorial Codeigniter 4',
				'slug' => 'tutorial-codeigniter-4'
			],
			[
				'name' => 'Tutorial PHP',
				'slug' => 'tutorial-php'
			],
			[
				'name' => 'Tutorial MySQL',
				'slug' => 'tutorial-mysql'
			],
		];

		$this->db->table('categories')->insertBatch($categories);
	}
}
