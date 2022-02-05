<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Entities\User;

class UserSeeder extends Seeder
{
	public function run()
	{
        /**
         * First, seed our example groups.
         */
		$groups = [
            [
                'name' => 'admin',
                'description' => 'Group for administrator.  Have full access through application features.'
            ],
            [
                'name' => 'maintainer',
                'description' => 'Group for maintainer.  This user set page, and setting for website.'
            ],
            [
                'name' => 'writer',
                'description' => 'Group for writer.  This user can create article.'
            ],
            [
                'name' => 'member',
                'description' => 'Group for member.  Default group for newly registered users.'
            ]
        ];

        $this->db->table('auth_groups')->insertBatch($groups);

        /**
         * Then, seed our example permissions.
         */
        $permissions = [
            [
                'name' => 'read-article',
                'description' => 'Basic permission to read or view article.'
            ],
            [
                'name' => 'create-article',
                'description' => 'Permission to create new article.'
            ],
            [
                'name' => 'update-article',
                'description' => 'Permission to update existing article.'
            ],
            [
                'name' => 'delete-article',
                'description' => 'Permission to delete existing article.'
            ],
            [
                'name' => 'read-category',
                'description' => 'Basic permission to read or view category.'
            ],
            [
                'name' => 'create-category',
                'description' => 'Permission to create new category.'
            ],
            [
                'name' => 'update-category',
                'description' => 'Permission to update existing category.'
            ],
            [
                'name' => 'delete-category',
                'description' => 'Permission to delete existing category.'
            ],
            [
                'name' => 'read-user',
                'description' => 'Basic permission to read or view user.'
            ],
            [
                'name' => 'create-user',
                'description' => 'Permission to create new user.'
            ],
            [
                'name' => 'update-user',
                'description' => 'Permission to update existing user.'
            ],
            [
                'name' => 'delete-user',
                'description' => 'Permission to delete existing user.'
            ],
            [
                'name' => 'read-setting',
                'description' => 'Basic permission to read or view setting.'
            ],
            [
                'name' => 'create-setting',
                'description' => 'Permission to create new setting.'
            ],
            [
                'name' => 'update-setting',
                'description' => 'Permission to update existing setting.'
            ],
            [
                'name' => 'delete-setting',
                'description' => 'Permission to delete existing setting.'
            ],
            [
                'name' => 'read-page',
                'description' => 'Basic permission to read or view page.'
            ],
            [
                'name' => 'create-page',
                'description' => 'Permission to create new page.'
            ],
            [
                'name' => 'update-page',
                'description' => 'Permission to update existing page.'
            ],
            [
                'name' => 'delete-page',
                'description' => 'Permission to delete existing page.'
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($permissions);

        /**
         * Assign our groups with permissions.
         */
        $group_permissions = [
            ['group_id' => 1, 'permission_id' => 1],
            ['group_id' => 1, 'permission_id' => 2],
            ['group_id' => 1, 'permission_id' => 3],
            ['group_id' => 1, 'permission_id' => 4],
            ['group_id' => 1, 'permission_id' => 5],
            ['group_id' => 1, 'permission_id' => 6],
            ['group_id' => 1, 'permission_id' => 7],
            ['group_id' => 1, 'permission_id' => 8],
            ['group_id' => 1, 'permission_id' => 9],
            ['group_id' => 1, 'permission_id' => 10],
            ['group_id' => 1, 'permission_id' => 11],
            ['group_id' => 1, 'permission_id' => 12],
            ['group_id' => 1, 'permission_id' => 13],
            ['group_id' => 1, 'permission_id' => 14],
            ['group_id' => 1, 'permission_id' => 15],
            ['group_id' => 1, 'permission_id' => 16],
            ['group_id' => 1, 'permission_id' => 17],
            ['group_id' => 1, 'permission_id' => 18],
            ['group_id' => 1, 'permission_id' => 19],
            ['group_id' => 1, 'permission_id' => 20],
            ['group_id' => 2, 'permission_id' => 20],
            ['group_id' => 2, 'permission_id' => 19],
            ['group_id' => 2, 'permission_id' => 18],
            ['group_id' => 2, 'permission_id' => 17],
            ['group_id' => 2, 'permission_id' => 16],
            ['group_id' => 2, 'permission_id' => 15],
            ['group_id' => 2, 'permission_id' => 14],
            ['group_id' => 2, 'permission_id' => 13],
            ['group_id' => 3, 'permission_id' => 1],
            ['group_id' => 3, 'permission_id' => 2],
            ['group_id' => 3, 'permission_id' => 3],
            ['group_id' => 3, 'permission_id' => 4],
            ['group_id' => 3, 'permission_id' => 5],
            ['group_id' => 3, 'permission_id' => 6],
            ['group_id' => 3, 'permission_id' => 7],
            ['group_id' => 3, 'permission_id' => 8],
        ];

        $this->db->table('auth_groups_permissions')->insertBatch($group_permissions);

        /**
         * Seed our example users.
         */
        $dummy_user_admin = [
            'email' => 'admin@example.com',
            'name' => 'Arif Purnomo Aji',
            'username' => 'admin',
            'password' => 'password',
        ];

        $dummy_user_maintainer = [
            'email' => 'maintainer@example.com',
            'name' => 'James Sullivan',
            'username' => 'maintainer',
            'password' => 'password',
        ];

        $dummy_user_writer = [
            'email' => 'writer@example.com',
            'name' => 'Brian Haner Jr.',
            'username' => 'writer',
            'password' => 'password',
        ];

        $dummy_user_member = [
            'email' => 'member@example.com',
            'name' => 'Dul Zkaedi',
            'username' => 'member',
            'password' => 'password',
        ];

        $users = model(UserModel::class);
        $userAdmin = new User($dummy_user_admin);
        $userAdmin->activate();
        $users->withGroup('admin')->save($userAdmin);
        
        $userMaintainer = new User($dummy_user_maintainer);
        $userMaintainer->activate();
        $users->withGroup('maintainer')->save($userMaintainer);

        $userWriter = new User($dummy_user_writer);
        $userWriter->activate();
        $users->withGroup('writer')->save($userWriter);

        $userMember = new User($dummy_user_member);
        $userMember->activate();
        $users->withGroup('member')->save($userMember);
	}
}
