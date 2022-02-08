<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'settings';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['site_name', 'site_description', 'site_logo', 'facebook_link', 'twitter_link', 'instagram_link', 'github_link'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'site_name' => [
			'label' => 'Site Name',
			'rules'  => 'required|string'
		],
		'site_description' => [
			'label' => 'Site Description',
			'rules'  => 'string'
		],
		'site_logo' => [
			'label' => 'Site Logo',
			'rules'  => 'uploaded[site_logo]|is_image[site_logo]'
		],
		'facebook_link' => [
			'label' => 'Facebook Link',
			'rules'  => 'string'
		],
		'twitter_link' => [
			'label' => 'Twitter Link',
			'rules'  => 'string'
		],
		'instagram_link' => [
			'label' => 'Instagram Link',
			'rules'  => 'string'
		],
		'github_link' => [
			'label' => 'Github Link',
			'rules'  => 'string'
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
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}
