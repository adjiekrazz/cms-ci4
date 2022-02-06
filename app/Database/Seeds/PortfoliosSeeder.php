<?php

namespace App\Database\Seeds;

use App\Models\PortfolioModel;
use CodeIgniter\Database\Seeder;

class PortfoliosSeeder extends Seeder
{
	public function run()
	{
		$portfolios = [
			[
				'title' => 'Woody HRMS',
				'slug' => 'portfolio/' . strtolower(url_title('Woody HRMS')),
				'content' => '<p>Human Resources Management System<br>Made using :<br></p><ol><li>Codeigniter 3</li><li>Bootstrap 4</li></ol><p></p>',
				'cover' => '',
				'date' => '2018/08/01'
			]
		];

		$portfolioModel = new PortfolioModel();
		$portfolioModel->insertBatch($portfolios);
	}
}
