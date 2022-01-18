<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use Myth\Auth\Models\UserModel;

class Profile extends BaseController
{
    use ResponseTrait;
    protected $validation;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

	public function index()
	{
        $data = [
            'user' => user()
        ];

		return view('profile', $data);
	}

    public function changePassword()
    {
        $rules = [
			'old_password' => 'required',
			'new_password' => 'required',
			'new_password_confirmation' => 'required|matches[new_password]',
		];

		if ($this->validate($rules)){
            $oldPassword = base64_encode(hash('sha384', $this->request->getPost('old_password'), true));
            $check = password_verify($oldPassword, user()->password_hash);

            if (!$check) return $this->fail(['old_password' => 'Password didn\'t match'], 422, 'Old password didn\'t match');
            $userModel = new UserModel();
            $user = $userModel->find(user()->id);
            if ($user){
                $user->setPassword($this->request->getPost('new_password'));
                $userModel->save($user);
                return $this->respondUpdated(user(), 'Password Changed');
            }
            return $this->respond(null, 404, 'User not found.');
        } else {    
            return $this->failValidationErrors($this->validation->getErrors());
		}
    }
}
