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
				'slug' => 'page/services',
				'content' => '',
			],
			[
				'title' => 'About',
				'slug' => 'page/about',
				'content' => '',
			],
			[
				'title' => 'Contact',
				'slug' => 'page/contact',
				'content' => '',
			],
		];

		$pageModel = new PageModel();
		$pageModel->insertBatch($pages);
	}
}
