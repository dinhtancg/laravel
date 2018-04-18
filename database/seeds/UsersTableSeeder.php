<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => '1',
                'name' => 'root',
                'email' => 'root@gmail.com',
                'password' =>  Hash::make('123456'),
                'first_login' => false,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '2',
                'name' => 'secrectory',
                'email' => 'secrectory@gmail.com',
                'password' =>  Hash::make('123456'),
                'first_login' => false,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '3',
                'name' => 'editor',
                'email' => 'editor@gmail.com',
                'password' =>  Hash::make('123456'),
                'first_login' => false,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '4',
                'name' => 'author',
                'email' => 'author@gmail.com',
                'password' =>  Hash::make('123456'),
                'first_login' => false,
                'created_at' => Carbon::now(),
            ],
        ];
        DB::table('users')->delete();
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        };
    }
}
