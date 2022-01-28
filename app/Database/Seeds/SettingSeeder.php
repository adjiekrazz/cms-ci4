<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingSeeder extends Seeder
{
	public function run()
	{
		$setting = [
			'site_name' => 'Arif Purnomo Daily',
			'site_description' => 'My daily activity blog',
			'site_logo' => '',
			'facebook_link' => 'Arif Purnomo Aji',
			'twitter_link' => 'Arif Purnomo Aji',
			'instagram_link' => 'Arif Purnomo Aji',
			'github_link' => 'adjiekrazz',
		];

		$this->db->table('settings')->insert($setting);
	}
}
