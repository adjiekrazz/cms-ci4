<?php

namespace App\Models;

use CodeIgniter\Files\Exceptions\FileNotFoundException;
use CodeIgniter\Files\File;
use CodeIgniter\Model;
use Myth\Auth\Models\UserModel;

class ArticleModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'articles';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['title', 'slug', 'content', 'cover', 'author_id', 'category_id', 'status'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'title' => [
			'label' => 'Title',
			'rules'  => 'required|string'
		],
		'category_id' => [
			'label' => 'Category',
			'rules'  => 'required|integer'
		],
		'content' => [
			'label' => 'Content',
			'rules'  => 'string'
		],
		'cover' => [
			'label' => 'Cover',
			'rules'  => 'uploaded[cover]|is_image[cover]'
		],
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
	protected $afterFind            = ['withAuthor', 'withCategory', 'renderCoverImage'];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	protected function withAuthor(array $arrayData)
	{
		$authorModel = new UserModel();
		
		foreach ($arrayData['data'] as &$data){
			$authorId = $data['author_id'];

			if (! isset($authorId)) continue;

			$data['author'] = $authorModel->find($authorId);
		}
		
		return $arrayData;
	}

	protected function withCategory(array $arrayData)
	{
		$categoryModel = new CategoryModel();
		
		foreach ($arrayData['data'] as &$data){
			$categoryId = $data['category_id'];

			if (! isset($categoryId)) continue;

			$data['category'] = $categoryModel->find($categoryId);
		}
		
		return $arrayData;
	}

	protected function renderCoverImage(array $arrayData)
	{
		foreach ($arrayData['data'] as &$data){
			$fileName = $data['cover'];
			
			try {
				$file = new File(WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $fileName, true);
			} catch (FileNotFoundException $notFound){
				$data['cover'] = "Image isn't found";
				continue;
			}

			$data['cover'] = "<img width='150' height='150' src='ImageRender/$fileName'/>";
		}
		
		return $arrayData;
	}
}
