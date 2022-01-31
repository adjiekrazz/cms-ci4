<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User as UserEntity;
use App\Models\ArticleModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
	use ResponseTrait;

	protected $model;
    protected $articleModel;
	protected $validation;
    protected $authorization;
    protected $db;

	public function __construct()
	{
		$this->model = new UserModel();
        $this->articleModel = new ArticleModel();
		$this->validation = \Config\Services::validation();
        $this->authorization = service('authorization');
        $this->db = \Config\Database::connect();
	}

	public function index()
	{
        $data = [
            'auth_groups' => $this->authorization->groups(),
            'users' => $this->model->findAll()
        ];
		return view('user', $data);
	}

	public function getUsers()
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
        $users_query = $this->model->orderBy($order_field, $order_ascdesc);
        if ($search) {
            $users_query = $users_query->like('email', $search);
            $users_query = $users_query->orLike('username', $search);
        }
        $users_data = $users_query->findAll($limit, $start);
        $users_filter_total = $users_query->countAll();
        $users_total = $this->model->countAll();

        $callback = array(
            'draw' => $this->request->getVar('draw'),
            'recordsTotal' => $users_total,
            'recordsFiltered' => $users_filter_total,
            'data' => $users_data,
        );

        header('Content-Type: application/json');
        echo json_encode($callback);
	}

	public function addUser()
    {
        if (! has_permission('create'))
            return $this->failForbidden("You don't have permissions to create new resources.");

        $user_data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'password_confirmation' => $this->request->getPost('password_confirmation'),
            'auth_groups' => $this->request->getPost('auth_groups')
        ];

		$this->validation->setRules([
            'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
            'password' => 'required',
            'password_confirmation' => 'required|matches[password]',
        ]);

		if (! $this->validation->run($user_data))
			return $this->failValidationErrors($this->validation->getErrors());

        $user = new UserEntity($user_data);
        $user->activate();

		if (!$result = $this->model->insert($user))
            return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException());
		
        if (!empty($user_data['auth_groups'])){
            $groups = explode(',', $user_data['auth_groups']);
            foreach ($groups as $group){
                $this->authorization->addUserToGroup($result, $group);
            }
        }

        return $this->respondCreated($user->toArray());
    }

    public function editUser()
    {
        if (! has_permission('update'))
            return $this->failForbidden("You don't have permissions to edit resources.");
        
        $user_data = [
            'id' => $this->request->getPost('id'),
			'password' => $this->request->getPost('password'),
			'password_confirmation' => $this->request->getPost('password_confirmation'),
            'auth_groups' => $this->request->getPost('auth_groups'),
        ];

        $this->validation->setRules([
            'id' => 'required|integer',
            'password' => 'permit_empty|min_length[6]',
            'password_confirmation' => 'matches[password]',
        ]);

        if (!$this->validation->run($user_data))
            return $this->failValidationErrors($this->validation->getErrors());

        $user = $this->model->find($user_data['id']);

        if ($user_data['password'])
            $user->setPassword($user_data['password']);

        try {
            $this->db->transBegin();
            if ($user->roles) {
                foreach ($user->roles as $role) {
                    $this->authorization->removeUserFromGroup($user_data['id'], $role);
                }
            }

            if ($user_data['auth_groups']) {
                $groups = explode(',', $user_data['auth_groups']);
                foreach ($groups as $group){
                    $this->authorization->addUserToGroup($user_data['id'], $group);
                }
            }
            
            $this->model->save($user);
            $this->db->transCommit();
        } catch (\Exception $error) {
            $this->db->transRollback();
            return $this->fail($error);
        }
    
        return $this->respondCreated($user_data);
    }

    public function deleteUser($id = null)
    {
        if (! has_permission('delete'))
            return $this->failForbidden("You don't have permissions to delete resources.");

        if ($id === null)
            return $this->failNotFound('User ID cannot be null');

        $transferToId = $this->request->getPost('transfer_ownership');
        if ($id == $transferToId)
            return $this->fail('Please choose other user for new articles ownership');

        try {
            $this->db->transBegin();
            $user = $this->model->find($id);
            $articles = $this->articleModel->where('author_id', $id)->get();
            foreach ($articles->getResult() as $article){
                $article->author_id = $transferToId;
                $this->articleModel->save($article);
            }
            foreach ($user->roles as $role) {
                $this->authorization->removeUserFromGroup($user->id, $role);
            }
            $this->model->delete($user->id);
            $this->db->transCommit();
        } catch (\Exception $error) {
            $this->db->transRollback();
            return $this->fail($error);
        } finally {

        }
        
        return $this->respondDeleted($id); 
    }
}
