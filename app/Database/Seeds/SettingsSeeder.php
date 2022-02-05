<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsSeeder extends Seeder
{
	public function run()
	{
		$setting = [
			'site_name' => 'APA Daily',
			'site_description' => 'Tech guy who loves to share anything about technology.',
			'site_logo' => '',
			'facebook_link' => '#',
			'twitter_link' => '#',
			'instagram_link' => '#',
			'github_link' => 'https://github.com/adjiekrazz',
		];

		$this->db->table('settings')->insert($setting);
	}
}
