<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$this->call('UsersSeeder');
		$this->call('CategoriesSeeder');
		$this->call('SettingsSeeder');
		$this->call('ArticlesSeeder');
		$this->call('PagesSeeder');
		$this->call('PortfoliosSeeder');
	}
}
