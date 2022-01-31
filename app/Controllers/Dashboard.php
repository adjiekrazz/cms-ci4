<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\PageModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
	protected $articleModel;
	protected $categoryModel;
	protected $userModel;
	protected $pageModel;

	public function __construct()
	{
		$this->articleModel = new ArticleModel();
		$this->categoryModel = new CategoryModel();
		$this->userModel = new UserModel();
		$this->pageModel = new PageModel();
	}

	public function index()
	{
		$data = [
			'articles' => $this->articleModel->countAllResults(),
			'categories' => $this->categoryModel->countAllResults(),
			'users' => $this->userModel->countAllResults(),
			'pages' => $this->pageModel->countAllResults(),
		];
		return view('dashboard', $data);
	}
}
