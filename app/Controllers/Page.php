<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PageModel;
use CodeIgniter\API\ResponseTrait;

class Page extends BaseController
{
	use ResponseTrait;
	protected $model;
	protected $validation;

	public function __construct()
	{
		$this->model = new PageModel();
		$this->validation = \Config\Services::validation();
	}

	public function index()
	{
		return view('page');
	}

	public function getPages()
	{
		if (! has_permission('read-page')){
            return $this->failForbidden("You don't have permissions to view resources.");
        }

        $search = $this->request->getVar('search')['value'];
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $order_index = $this->request->getVar('order')[0]['column'];
        $order_field = $this->request->getVar('columns')[$order_index]['data'];
        $order_ascdesc = $this->request->getVar('order')[0]['dir'];
        $pages_query = $this->model->orderBy($order_field, $order_ascdesc);
        if ($search) {
            $pages_query = $pages_query->like('name', $search);
            $pages_query = $pages_query->orLike('slug', $search);
        }
        $pages_data = $pages_query->findAll($limit, $start);
        $pages_filter_total = $pages_query->countAll();
        $pages_total = $this->model->countAll();

        $callback = array(
            'draw' => $this->request->getVar('draw'),
            'recordsTotal' => $pages_total,
            'recordsFiltered' => $pages_filter_total,
            'data' => $pages_data,
        );

        header('Content-Type: application/json');
        echo json_encode($callback);
	}

	public function addPage()
    {
        if (! has_permission('create-page'))
            return $this->failForbidden("You don't have permissions to create new resources.");

        $pages_data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];
		$this->validation->setRules($this->model->validationRules);

		if (! $this->validation->run($pages_data))
			return $this->failValidationErrors($this->validation->getErrors());

        $pages_data['slug'] = 'page/' . strtolower(url_title($this->request->getPost(('title'))));

		if ($this->model->save($pages_data))
		    return $this->respondCreated($pages_data);
        
        return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException());
    }

    public function editPage()
    {
        if (! has_permission('update-page'))
            return $this->failForbidden("You don't have permissions to edit resources.");
        
        $pages_data = [
            'id' => $this->request->getPost('id'),
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];

        $this->validation->setRules($this->model->validationRules);
        if (!$this->validation->run($pages_data))
            return $this->failValidationErrors($this->validation->getErrors());

        $pages_data['slug'] = 'page' . strtolower(url_title($this->request->getPost(('title'))));
    
        if ($this->model->save($pages_data))
            return $this->respondCreated($pages_data);
        
        return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException()); 
            
    }

    public function deletePage($id = null)
    {
        if ($id === null)
            return $this->failNotFound('Page ID cannot be null');

        if (! has_permission('delete-page'))
            return $this->failForbidden("You don't have permissions to delete resources.");
        
        if ($this->model->delete($id))
            return $this->respondDeleted($id);
        
        return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException()); 
    }
}
