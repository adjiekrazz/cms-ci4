<?php

namespace App\Database\Seeds;

use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class ArticlesSeeder extends Seeder
{
	protected $categoryModel;
	protected $userModel;
	protected $articleModel;
	
	public function __construct()
	{
		$this->categoryModel = new CategoryModel();
		$this->userModel = new UserModel();
		$this->articleModel = new ArticleModel();
	}

	public function run()
	{
		$articles = [
			[
				'title' => 'Auth Package untuk Codeigniter 4',
				'slug' => strtolower(url_title('Auth Package untuk Codeigniter 4')),
				'content' => '<p style="text-align: left;">Daftar Isi :</p><ol><li style="text-align: left;">Apa itu Codeigniter 4 ?</li>'
							. '<li style="text-align: left;">Apa itu Myth-Auth ?</li><li style="text-align: left;">Bagaimana cara install myth-auth di Codeigniter 4?</li></ol>',
				'cover' => null,
				'author_id' => $this->userModel->where('username', 'admin')->first()->id,
				'category_id' => $this->categoryModel->where('name', 'Tutorial Codeigniter 4')->first()['id'],
				'status' => 'publish',
			],
			[
				'title' => 'Tutorial Membuat Replikasi di MySQL',
				'slug' => strtolower(url_title('Tutorial Membuat Replikasi di MySQL')),
				'content' => '<p style="text-align: left;">Daftar Isi :</p><ol><li style="text-align: left;">Apa itu MySQL ?</li>'
							. '<li style="text-align: left;">Apa itu Replikasi ?</li><li style="text-align: left;">Bagaimana membuat replikasi database secara otomatis di MySQL ?</li></ol>',
				'cover' => null,
				'author_id' => $this->userModel->where('username', 'writer')->first()->id,
				'category_id' => $this->categoryModel->where('name', 'Tutorial MySQL')->first()['id'],
				'status' => 'publish',
			],
			[
				'title' => 'Tutorial Eloquent di Laravel',
				'slug' => strtolower(url_title('Tutorial Eloquent di Laravel')),
				'content' => '<p style="text-align: left;">Daftar Isi :</p><ol><li style="text-align: left;">Apa itu Eloquent ?</li>'
							. '<li style="text-align: left;">Apa itu Laravel ?</li><li style="text-align: left;">Bagaimana menggunakan Eloquent di Laravel ?</li></ol>',
				'cover' => null,
				'author_id' => $this->userModel->where('username', 'writer')->first()->id,
				'category_id' => $this->categoryModel->where('name', 'Tutorial PHP')->first()['id'],
				'status' => 'publish',
			],
			[
				'title' => 'Standar PSR dalam PHP',
				'slug' => strtolower(url_title('Standar PSR dalam PHP')),
				'content' => '<p style="text-align: left;">Daftar Isi :</p><ol><li style="text-align: left;">Apa itu PSR ?</li>'
							. '<li style="text-align: left;">Apa itu PHP ?</li><li style="text-align: left;">Apa saja standar PSR yang wajib diterapkan dalam PHP ?</li></ol>',
				'cover' => null,
				'author_id' => $this->userModel->where('username', 'maintainer')->first()->id,
				'category_id' => $this->categoryModel->where('name', 'Tutorial PHP')->first()['id'],
				'status' => 'draft',
			],
		];

		foreach ($articles as $article){
			$this->articleModel->insert($article);
		}
	}
}
