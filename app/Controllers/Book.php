<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use CodeIgniter\API\ResponseTrait;

class Book extends BaseController
{
    use ResponseTrait;
    protected $model;
    protected $validation;
    protected $authorization;
    protected $authentication;

    public function __construct()
    {
        $this->model = new BookModel();
        $this->validation = \Config\Services::validation();
        $this->authorization = service('authorization');
        $this->authentication = service('authentication');
    }

	public function index()
	{
		return view('book');
	}

    public function getBooks()
    {
        if (! $this->authorization->hasPermission('read', $this->authentication->user()->id)){
            return $this->failForbidden("You don't have permissions to view resources.");
        } else {
            $search = $this->request->getVar('search')['value'];
            $limit = $this->request->getVar('length');
            $start = $this->request->getVar('start');
            $order_index = $this->request->getVar('order')[0]['column'];
            $order_field = $this->request->getVar('columns')[$order_index]['data'];
            $order_ascdesc = $this->request->getVar('order')[0]['dir'];

            $books_query = $this->model->orderBy($order_field, $order_ascdesc);
            if ($search)
            {
                $books_query = $books_query->like('code', $search);
                $books_query = $books_query->orLike('title', $search);
                $books_query = $books_query->orLike('year', $search);
                $books_query = $books_query->orLike('author', $search);
                $books_query = $books_query->orLike('publisher', $search);
                $books_query = $books_query->orLike('publication_year', $search);
                $books_query = $books_query->orLike('status', $search);
            }
            $books_data = $books_query->findAll($limit, $start);
            $books_filter_total = $books_query->countAll();
            $books_total = $this->model->countAll();

            $callback = array(
                'draw' => $this->request->getVar('draw'),
                'recordsTotal' => $books_total,
                'recordsFiltered' => $books_filter_total,
                'data' => $books_data,
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
    }

    public function addBook()
    {
        if (! $this->authorization->hasPermission('create', $this->authentication->user()->id)){
            return $this->failForbidden("You don't have permissions to create new resources.");
        } else {
            $books_data = $this->request->getRawInput();
            
            $this->validation->setRules($this->model->validationRules);
            if ($this->validation->run($books_data))
            {
                $this->model->save($books_data);
                return $this->respondCreated($books_data);
            } else {
                return $this->failValidationErrors($this->validation->getErrors());
            }
        }
    }

    public function editBook()
    {
        if (! $this->authorization->hasPermission('update', $this->authentication->user()->id)){
            return $this->failForbidden("You don't have permissions to edit resources.");
        } else {
            $books_data = [
                'code' => $this->request->getVar('code'),
                'title' => $this->request->getVar('title'),
                'author' => $this->request->getVar('author'),
                'publisher' => $this->request->getVar('publisher'),
                'year' => $this->request->getVar('year'),
                'publication_year' => $this->request->getVar('publication_year'),
                'status' => $this->request->getVar('status'),
            ];
            
            $this->validation->setRules($this->model->getValidationRules(['except' => ['code']]));
            if ($this->validation->run($books_data))
            {
                if ($this->model->update($this->request->getVar('id'), $books_data)) {
                    return $this->respondCreated($books_data);
                } else {
                    return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException()); 
                }
            } else {
                return $this->failValidationErrors($this->validation->getErrors());
            }
        }
    }

    public function deleteBook($id = null)
    {
        if ($id === null)
        {
            return $this->failNotFound('Book ID cannot be null');
        }

        if (! $this->authorization->hasPermission('delete', $this->authentication->user()->id)){
            return $this->failForbidden("You don't have permissions to delete resources.");
        } else {
            if ($this->model->delete($id))
            {
                $this->respondDeleted($id);
            }
        }
    }
}