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
				'slug' => 'category/' . strtolower(url_title('Tutorial Codeigniter 4'))
			],
			[
				'name' => 'Tutorial PHP',
				'slug' => 'category/' . strtolower(url_title('Tutorial PHP'))
			],
			[
				'name' => 'Tutorial MySQL',
				'slug' => 'category/' . strtolower(url_title('Tutorial MySQL'))
			],
		];

		$this->db->table('categories')->insertBatch($categories);
	}
}
