<?php

namespace App\Database\Seeds;

use App\Models\PageModel;
use CodeIgniter\Database\Seeder;

class PagesSeeder extends Seeder
{
	public function run()
	{
		$pages = [
			[
				'title' => 'Services',
				'slug' => 'services',
				'content' => '',
			],
			[
				'title' => 'About',
				'slug' => 'about',
				'content' => '',
			],
			[
				'title' => 'Contact',
				'slug' => 'contact',
				'content' => '',
			],
		];

		$pageModel = new PageModel();
		$pageModel->insertBatch($pages);
	}
}
