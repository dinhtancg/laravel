<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id' => '1',
                'name' => 'user-list',
                'description' => 'Show list User',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '2',
                'name' => 'user-create',
                'description' => 'Create user',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '3',
                'name' => 'user-edit',
                'description' => 'Edit user',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '4',
                'name' => 'delete-user',
                'description' => 'Delete user',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '5',
                'name' => 'role-list',
                'description' => 'Show list Roles',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '6',
                'name' => 'role-create',
                'description' => 'Create role',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '7',
                'name' => 'role-edit',
                'description' => 'Edit role',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '8',
                'name' => 'role-delete',
                'description' => 'Delete-role',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '9',
                'name' => 'category-list',
                'description' => 'Show list Category',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '10',
                'name' => 'category-create',
                'description' => '',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '11',
                'name' => 'category-edit',
                'description' => 'Edit category',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '12',
                'name' => 'category-delete',
                'description' => 'Delete-category',
                'created_at' => Carbon::now(),
            ],

        ];
        DB::table('permissions')->delete();
        foreach ($permissions as $permission) {
            DB::table('permissions')->insert($permission);
        };
    }
}
