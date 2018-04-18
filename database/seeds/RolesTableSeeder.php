<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => '1',
                'name' => 'Root',
                'slug' => 'root',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '2',
                'name' => 'Secrectory',
                'slug' => 'secrectory',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '3',
                'name' => 'Editor',
                'slug' => 'editor',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '4',
                'name' => 'Author',
                'slug' => 'author',
                'created_at' => Carbon::now(),
            ],
        ];

        DB::table('roles')->delete();
        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        };
    }
}
