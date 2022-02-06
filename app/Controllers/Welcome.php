<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\PageModel;
use App\Models\PortfolioModel;
use App\Models\SettingModel;

class Welcome extends BaseController
{
	protected $articleModel;
	protected $settingModel;
	protected $categoryModel;
	protected $pageModel;
	protected $portfolioModel;

	public function __construct()
	{
		$this->articleModel = new ArticleModel();
		$this->settingModel = new SettingModel();
		$this->categoryModel = new CategoryModel();
		$this->pageModel = new PageModel();
		$this->portfolioModel = new PortfolioModel();
	}

	public function index()
	{
		$data = [
			'articles' => $this->articleModel->where('status', 'publish')->orderBy('created_at', 'desc')->findAll(3, 0),
			'portfolios' => $this->portfolioModel->findAll(3, 0),
			'setting' => $this->settingModel->first()
		];

		return view('frontend/home', $data);
	}

	public function single($slug)
	{
		$article = $this->articleModel->where('slug', $slug)->where('status', 'publish')->first();

		if (! $article)
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

		$data = [
			'article' => $article,
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

	public function portfolio($slug)
	{
		$data = [
			'portfolio' => $this->portfolioModel->where('slug', 'portfolio/' . $slug)->first(),
			'setting' => $this->settingModel->first(),
		];

		if ($data['portfolio'] !== null){
			$data['portfolio']['cover'] = 'ImageRender/' . $data['portfolio']['cover'];
		}

		return view('frontend/portfolio', $data);
	}

	public function category($slug)
	{
		$category = $this->categoryModel->where('slug', 'category/' . $slug)->first();

		if(! $category)
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		
		$data = [
			'setting' => $this->settingModel->first(),
			'feed_articles' => $this->articleModel->where('status', 'publish')->orderBy('rand()')->findAll(5, 0),
			'categories' => $this->categoryModel->findAll(),
			'articles' => $this->articleModel->where('category_id', $category['id'])->where('status', 'publish')->paginate(3, 'articles'),
			'articles_pager' => $this->articleModel->pager,
		];

		return view('frontend/category', $data);
	}

	public function search()
	{
		$uri = service('uri');
		$search = $uri->getSegment(2)
			? $uri->getSegment(2)
			: htmlentities((trim($this->request->getPost('search')))? trim($this->request->getPost('search')): '');


		$data = [
			'setting' => $this->settingModel->first(),
			'articles' => $this->articleModel->groupStart()
					->where('status', 'publish')
						->groupStart()
							->like('title', $search)
							->orLike('content', $search)
						->groupEnd()
					->groupEnd()
					->paginate(4),
			'articles_pager' => $this->articleModel->pager,
			'feed_articles' => $this->articleModel->where('status', 'publish')->orderBy('rand()')->findAll(5, 0),
			'categories' => $this->categoryModel->findAll(),
			'search' => $search,
		];

		return view('frontend/search', $data);
	}

	public function notFound()
	{
		$data = [
			'setting' => $this->settingModel->first()
		];

		echo view('frontend/not_found', $data);
	}
}