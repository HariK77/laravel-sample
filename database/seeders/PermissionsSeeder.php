<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grants = array(
            'See All Users', 'Create User', 'See User', 'Edit User', 'Delete User',
            'See All Roles', 'Create Role', 'See Role', 'Edit Role', 'Delete Role',
            'See All Permissions', 'Create Permission', 'See Permission', 'Edit Permission', 'Delete Permission',
            'See All Categories', 'Create Category', 'See Category', 'Edit Category', 'Delete Category',
            'See All Galleries', 'Create Gallery', 'See Gallery', 'Edit Gallery', 'Delete Gallery',
            'See Excel Operations', 'See Ajax Operations'
        );

        foreach ($grants as $grant) {
            Permission::create(['name' => $grant]);
        }

    }
}
