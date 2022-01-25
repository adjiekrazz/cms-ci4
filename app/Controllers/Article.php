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
		return view('article', $data);
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
			'status' => $this->request->getPost('status'),
			'cover' => $this->request->getFile('cover'),
		];
		$this->validation->setRules($this->model->validationRules);

		if (! $this->validation->run($articles_data))
			return $this->failValidationErrors($this->validation->getErrors());
		
		$coverImage = $articles_data['cover'];
		$cover = $coverImage->getRandomName();
		$articles_data['cover'] = $cover;
		$articles_data['slug'] = $this->categoryModel->find($this->request->getPost('category_id'))['slug'];
		
		if (! $this->model->save($articles_data))
			return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException());

		if (! $coverImage->hasMoved())
			$coverImage->move(WRITEPATH . 'uploads', $cover);

		return $this->respondCreated($articles_data);
    }

	public function editArticle()
    {
        if (! has_permission('update'))
            return $this->failForbidden("You don't have permissions to edit resources.");
        
        if (! $id = $this->request->getPost('id'))
            return $this->fail('Article ID required.');

        $articles_data = [
            'title' => $this->request->getPost('title'),
			'category_id' => $this->request->getPost('category_id'),
			'author_id' => user_id(),
			'content' => $this->request->getPost('content'),
			'status' => $this->request->getPost('status'),
        ];

        $coverImage = $this->request->getFile('cover');
        if ($coverImage->getSize() === 0) {
            $this->validation->setRules($this->model->getValidationRules(['except' => ['cover']]));
        } else {
            $articles_data['cover'] = $coverImage;
            $this->validation->setRules($this->model->getValidationRules());
        }

        if (!$this->validation->run($articles_data))
            return $this->failValidationErrors($this->validation->getErrors());

        if ($coverImage->getSize() !== 0) {
            $cover = $coverImage->getRandomName();
            $articles_data['cover'] = $cover;
        }

        $articles_data['slug'] = $this->categoryModel->find($this->request->getPost('category_id'))['slug'];

        if (! $this->model->update($id, $articles_data))
            return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException()); 

        if ($coverImage->getSize() !== 0){
            if (! $coverImage->hasMoved())
			    $coverImage->move(WRITEPATH . 'uploads', $cover);
        }

        return $this->respondUpdated($articles_data);
    }

	public function deleteArticle($id = null)
    {
        if ($id === null)
            return $this->failNotFound('Article ID cannot be null');

        if (! has_permission('delete'))
            return $this->failForbidden("You don't have permissions to delete resources.");
        
        if ($this->model->delete($id))
            return $this->respondDeleted($id);
        
        return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException()); 
    }
}
