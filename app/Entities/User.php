<?php namespace App\Entities;

use Myth\Auth\Entities\User as MythUser;

class User extends MythUser
{
    public function withRoles()
    {
        $this->attributes['roles'] = $this->getRoles();

        return $this;
	}
}
