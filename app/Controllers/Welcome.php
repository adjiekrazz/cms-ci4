<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\PageModel;
use App\Models\SettingModel;

class Welcome extends BaseController
{
	protected $articleModel;
	protected $settingModel;
	protected $categoryModel;
	protected $pageModel;

	public function __construct()
	{
		$this->articleModel = new ArticleModel();
		$this->settingModel = new SettingModel();
		$this->categoryModel = new CategoryModel();
		$this->pageModel = new PageModel();
	}

	public function index()
	{
		$data = [
			'articles' => $this->articleModel->where('status', 'publish')->orderBy('created_at', 'desc')->findAll(3, 0),
			'setting' => $this->settingModel->first()
		];

		return view('frontend/home', $data);
	}

	public function single($slug)
	{
		$data = [
			'article' => $this->articleModel->where('slug', $slug)->where('status', 'publish')->first(),
			'feed_articles' => $this->articleModel->where('status', 'publish')->orderBy('rand()')->findAll(5, 0),
			'categories' => $this->categoryModel->findAll(),
			'setting' => $this->settingModel->first(),
		];

		return view('frontend/article', $data);
	}

	public function blog()
	{
		$data = [
			'setting' => $this->settingModel->first(),
			'feed_articles' => $this->articleModel->where('status', 'publish')->orderBy('rand()')->findAll(5, 0),
			'categories' => $this->categoryModel->findAll(),
			'articles' => $this->articleModel->where('status', 'publish')->paginate(3, 'articles'),
			'articles_pager' => $this->articleModel->pager,
		];

		return view('frontend/blog', $data);
	}

	public function page($slug)
	{
		$data = [
			'page' => $this->pageModel->where('slug', 'page/' . $slug)->first(),
			'setting' => $this->settingModel->first(),
		];

		return view('frontend/page', $data);
	}
}