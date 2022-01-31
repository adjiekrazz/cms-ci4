<?php namespace App\Models;

use Myth\Auth\Models\UserModel as MythModel;

class UserModel extends MythModel
{
    protected $returnType = 'App\Entities\User';
    protected $allowedFields = [
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at', 'roles',
    ];
    protected $afterFind = ['withGroups'];
    protected $beforeUpdate = ['withoutGroups'];

    protected function withGroups($data)
    {
        if (!is_array($data['data'])){
            $data['data']->withRoles();
        } else {
            foreach ($data['data'] as &$user){
                $user->withRoles();
            }
        }
        return $data;
    }

    protected function withoutGroups($data)
    {
        unset($data['data']['roles']);
        return $data;
    }
}