<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PortfolioModel;
use CodeIgniter\API\ResponseTrait;

class Portfolio extends BaseController
{
	use ResponseTrait;
	protected $model;
	protected $validation;

	public function __construct()
	{
		$this->model = new PortfolioModel();
		$this->validation = \Config\Services::validation();
	}

	public function index()
	{
		return view('portfolio');
	}

	public function getPortfolios()
	{
		if (! has_permission('read-portfolio')){
            return $this->failForbidden("You don't have permissions to view resources.");
        }

        $search = $this->request->getVar('search')['value'];
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $order_index = $this->request->getVar('order')[0]['column'];
        $order_field = $this->request->getVar('columns')[$order_index]['data'];
        $order_ascdesc = $this->request->getVar('order')[0]['dir'];
        $portfolios_query = $this->model->orderBy($order_field, $order_ascdesc);
        if ($search) {
            $portfolios_query = $portfolios_query->like('name', $search);
            $portfolios_query = $portfolios_query->orLike('slug', $search);
        }
        $portfolios_data = $portfolios_query->findAll($limit, $start);
        $portfolios_filter_total = $portfolios_query->countAll();
        $portfolios_total = $this->model->countAll();

        $callback = array(
            'draw' => $this->request->getVar('draw'),
            'recordsTotal' => $portfolios_total,
            'recordsFiltered' => $portfolios_filter_total,
            'data' => $portfolios_data,
        );

        header('Content-Type: application/json');
        echo json_encode($callback);
	}

	public function addPortfolio()
    {
        if (! has_permission('create-portfolio'))
            return $this->failForbidden("You don't have permissions to create new resources.");

		$portfolios_data = [
			'title' => $this->request->getPost('title'),
			'content' => $this->request->getPost('content'),
			'date' => $this->request->getPost('date'),
			'slug' => 'portfolio/' . strtolower(url_title($this->request->getPost('title'))),
		];

        $coverImage = $this->request->getFile('cover');
        if ($coverImage->getSize() === 0) {
            $this->validation->setRules($this->model->getValidationRules(['except' => ['cover']]));
        } else {
            $portfolios_data['cover'] = $coverImage;
            $this->validation->setRules($this->model->getValidationRules());
        }

		if (! $this->validation->run($portfolios_data))
			return $this->failValidationErrors($this->validation->getErrors());
		
        if ($coverImage->getSize() !== 0) {
            $coverName = $coverImage->getRandomName();
            $portfolios_data['cover'] = $coverName;

            if (! $coverImage->hasMoved())
			    $coverImage->move(WRITEPATH . 'uploads', $coverName);
        }

		if (! $this->model->save($portfolios_data))
			return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException());

		return $this->respondCreated($portfolios_data);
    }

	public function editPortfolio()
    {
        if (! has_permission('update-portfolio'))
            return $this->failForbidden("You don't have permissions to edit resources.");
        
        if (! $id = $this->request->getPost('id'))
            return $this->fail('Portfolio ID required.');

        $portfolios_data = [
            'id' => $id,
			'title' => $this->request->getPost('title'),
			'content' => $this->request->getPost('content'),
			'date' => $this->request->getPost('date'),
			'slug' => 'portfolio/' . strtolower(url_title($this->request->getPost('title'))),
        ];

        $coverImage = $this->request->getFile('cover');
        if ($coverImage->getSize() === 0) {
            $this->validation->setRules($this->model->getValidationRules(['except' => ['cover']]));
        } else {
            $portfolios_data['cover'] = $coverImage;
            $this->validation->setRules($this->model->getValidationRules());
        }

        if (!$this->validation->run($portfolios_data))
            return $this->failValidationErrors($this->validation->getErrors());

        if ($coverImage->getSize() !== 0) {
            $cover = $coverImage->getRandomName();
            $portfolios_data['cover'] = $cover;

            if (! $coverImage->hasMoved())
			    $coverImage->move(WRITEPATH . 'uploads', $cover);
        }

        if (! $this->model->save($portfolios_data))
            return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException()); 

        return $this->respondUpdated($portfolios_data);
    }

    public function deletePortfolio($id = null)
    {
        if ($id === null)
            return $this->failNotFound('Portfolio ID cannot be null');

        if (! has_permission('delete-portfolio'))
            return $this->failForbidden("You don't have permissions to delete resources.");
        
        if ($this->model->delete($id))
            return $this->respondDeleted($id);
        
        return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException()); 
    }
}
