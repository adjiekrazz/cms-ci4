<?php

namespace App\Models;

use CodeIgniter\Files\Exceptions\FileNotFoundException;
use CodeIgniter\Files\File;
use CodeIgniter\Model;

class PortfolioModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'portfolios';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['title', 'slug', 'content', 'cover', 'date'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'title' => [
			'label' => 'Title',
			'rules'  => 'required|string|is_unique[portfolios.title,id,{id}]'
		],
		'content' => [
			'label' => 'Content',
			'rules'  => 'string'
		],
		'cover' => [
			'label' => 'Cover',
			'rules'  => 'uploaded[cover]|is_image[cover]'
		],
		'date' => [
			'label' => 'Date',
			'rules' => 'date'
		]
	];
	protected $validationMessages   = [];
	protected $skipValidation       = true;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = ['renderCoverImage'];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	protected function renderCoverImage(array $arrayData)
	{
		if ($arrayData['data'] === null) 
			return $arrayData;
			
		if (isset($arrayData['data']['id'])) {
			$fileName = $arrayData['data']['cover'];

			try {
				new File(WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $fileName, true);
				$data['cover'] = 'ImageRender/' . $fileName;
			} catch (FileNotFoundException $notFound){
				$data['cover'] = "";
			}
		} else {
			foreach ($arrayData['data'] as &$data){
				$fileName = $data['cover'];
				
				try {
					new File(WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $fileName, true);
					$data['cover'] = 'ImageRender/' . $fileName;
				} catch (FileNotFoundException $notFound){
					$data['cover'] = "";
					continue;
				}
			}
		}
		
		return $arrayData;
	}
}
