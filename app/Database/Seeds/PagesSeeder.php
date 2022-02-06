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
				'content' => '<ol><li>Web Design<br><p>We provide web design services using figma or other prototyping applications.</p></li>'
					. '<li>Automation<br><p>Automate your server health recovery and extract error logs for further analysis.</p></li></ol>',
			],
			[
				'title' => 'About',
				'slug' => 'page/about',
				'content' => 'APA Daily is a place for me to share whatever in my mind about technology.',
			],
			[
				'title' => 'Contact',
				'slug' => 'page/contact',
				'content' => '<blockquote class="blockquote"><p><b>WhatsApp </b>: +62 882 2184 xxxx&nbsp;<br>'
					. '<b style="font-size: 1.25rem;">Email&nbsp;</b><span style="font-size: 1.25rem;">: admin@apadaily.com&nbsp; </span><br>'
					. '<b style="font-size: 1.25rem;">Alamat </b><span style="font-size: 1.25rem;">: Jl Secang Temanggung&nbsp;</span></p></blockquote>',
			],
		];

		$pageModel = new PageModel();
		$pageModel->insertBatch($pages);
	}
}
