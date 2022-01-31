<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;

class Category extends BaseController
{
	use ResponseTrait;
	protected $model;
	protected $validation;

	public function __construct()
	{
		$this->model = new CategoryModel();
		$this->validation = \Config\Services::validation();
	}

	public function index()
	{
		return view('category');
	}

	public function getCategories()
	{
		if (! has_permission('read-category')){
            return $this->failForbidden("You don't have permissions to view resources.");
        }

        $search = $this->request->getVar('search')['value'];
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $order_index = $this->request->getVar('order')[0]['column'];
        $order_field = $this->request->getVar('columns')[$order_index]['data'];
        $order_ascdesc = $this->request->getVar('order')[0]['dir'];
        $categories_query = $this->model->orderBy($order_field, $order_ascdesc);
        if ($search) {
            $categories_query = $categories_query->like('name', $search);
            $categories_query = $categories_query->orLike('slug', $search);
        }
        $categories_data = $categories_query->findAll($limit, $start);
        $categories_filter_total = $categories_query->countAll();
        $categories_total = $this->model->countAll();

        $callback = array(
            'draw' => $this->request->getVar('draw'),
            'recordsTotal' => $categories_total,
            'recordsFiltered' => $categories_filter_total,
            'data' => $categories_data,
        );

        header('Content-Type: application/json');
        echo json_encode($callback);
	}

	public function addCategory()
    {
        if (! has_permission('create-category'))
            return $this->failForbidden("You don't have permissions to create new resources.");

		$categories_data = $this->request->getRawInput();
		$this->validation->setRules($this->model->validationRules);

		if (! $this->validation->run($categories_data))
			return $this->failValidationErrors($this->validation->getErrors());

		if ($this->model->save($categories_data))
		    return $this->respondCreated($categories_data);
        
        return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException());
    }

    public function editCategory()
    {
        if (! has_permission('update-category'))
            return $this->failForbidden("You don't have permissions to edit resources.");
        
        $categories_data = [
            'name' => $this->request->getVar('name'),
            'slug' => $this->request->getVar('slug'),
        ];

        $this->validation->setRules($this->model->validationRules);
        if (!$this->validation->run($categories_data))
            return $this->failValidationErrors($this->validation->getErrors());
    
        if ($this->model->update($this->request->getVar('id'), $categories_data))
            return $this->respondCreated($categories_data);
        
        return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException()); 
            
    }

    public function deleteCategory($id = null)
    {
        if ($id === null)
            return $this->failNotFound('Category ID cannot be null');

        if (! has_permission('delete-category'))
            return $this->failForbidden("You don't have permissions to delete resources.");
        
        if ($this->model->delete($id))
            return $this->respondDeleted($id);
        
        return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException()); 
    }
}
