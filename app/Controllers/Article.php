<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;

class Article extends BaseController
{
	use ResponseTrait;
	protected $model;
	protected $categoryModel;
	protected $validation;

	public function __construct()
	{
		$this->model = new ArticleModel();
		$this->categoryModel = new CategoryModel();
		$this->validation = \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'categories' => $this->categoryModel->findAll()
		];
		return view('article/index', $data);
	}

	public function getArticles()
	{
		if (! has_permission('read')){
            return $this->failForbidden("You don't have permissions to view resources.");
        }
        
        $search = $this->request->getVar('search')['value'];
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $order_index = $this->request->getVar('order')[0]['column'];
        $order_field = $this->request->getVar('columns')[$order_index]['data'];
        $order_ascdesc = $this->request->getVar('order')[0]['dir'];
        $articles_query = $this->model->orderBy($order_field, $order_ascdesc);
        if ($search) {
            $articles_query = $articles_query->like('name', $search);
            $articles_query = $articles_query->orLike('slug', $search);
        }
        $articles_data = $articles_query->findAll($limit, $start);
        $articles_filter_total = $articles_query->countAll();
        $articles_total = $this->model->countAll();

        $callback = array(
            'draw' => $this->request->getVar('draw'),
            'recordsTotal' => $articles_total,
            'recordsFiltered' => $articles_filter_total,
            'data' => $articles_data,
        );

        header('Content-Type: application/json');
        echo json_encode($callback);
	}

	public function addArticle()
    {
        if (! has_permission('create'))
            return $this->failForbidden("You don't have permissions to create new resources.");

		$articles_data = [
			'title' => $this->request->getPost('title'),
			'category_id' => $this->request->getPost('category_id'),
			'author_id' => user_id(),
			'content' => $this->request->getPost('content'),
			'cover' => $this->request->getFile('cover'),
		];
		$this->validation->setRules($this->model->validationRules);

		if (! $this->validation->run($articles_data))
			return $this->failValidationErrors($this->validation->getErrors());
		
		$image = $articles_data['cover'];
		$fileName = $image->getRandomName();
		$articles_data['cover'] = $fileName;
		$articles_data['slug'] = $this->categoryModel->find($this->request->getPost('category_id'))['slug'];
		
		if (! $this->model->save($articles_data))
			return $this->respond(null, 500, 'Database error. Unable to add article');
		if (! $image->hasMoved())
			$image->move(WRITEPATH . 'uploads', $fileName);
		return $this->respondCreated($articles_data);
    }
}
