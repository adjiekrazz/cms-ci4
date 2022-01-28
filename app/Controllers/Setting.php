<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SettingModel;
use CodeIgniter\API\ResponseTrait;

class Setting extends BaseController
{
	use ResponseTrait;

	protected $model;
    protected $validation;

	public function __construct()
	{
		$this->model = new SettingModel();
        $this->validation = \Config\Services::validation();
	}

	public function index()
	{
		$data['setting'] = $this->model->first();
		return view('setting', $data);
	}

	public function editSetting()
    {
        if (! has_permission('update'))
            return $this->failForbidden("You don't have permissions to edit resources.");
        
        $settings_data = [
            'site_name' => $this->request->getPost('site_name'),
            'site_description' => $this->request->getPost('site_description'),
            'facebook_link' => $this->request->getPost('facebook_link'),
            'twitter_link' => $this->request->getPost('twitter_link'),
            'instagram_link' => $this->request->getPost('instagram_link'),
            'github_link' => $this->request->getPost('github_link')
        ];

        $siteLogo = $this->request->getFile('site_logo');
        if ($siteLogo->getSize() === 0) {
            $this->validation->setRules($this->model->getValidationRules(['except' => ['site_logo']]));
        } else {
            $articles_data['site_logo'] = $siteLogo;
            $this->validation->setRules($this->model->getValidationRules());
        }

        if (!$this->validation->run($settings_data))
            return $this->failValidationErrors($this->validation->getErrors());

        if ($siteLogo->getSize() !== 0) {
            $siteLogoName = $siteLogo->getRandomName();
            $articles_data['site_logo'] = $siteLogoName;
        }
    
        if (!$this->model->update($this->request->getVar('id'), $settings_data))
            return $this->fail(new \CodeIgniter\Database\Exceptions\DatabaseException()); 
        
        if ($siteLogo->getSize() !== 0){
            if (! $siteLogo->hasMoved())
                $siteLogo->move(WRITEPATH . 'uploads', $siteLogoName);
        }
        
        return $this->respondCreated($settings_data);
    }
}
