<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => '1',
                'name' => 'Thể Thao',
                'slug' => 'the-thao',
                'description' => 'Tin thế thao',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '2',
                'name' => 'Thế Giới',
                'slug' => 'the-gioi',
                'description' => 'Tin thế giới',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '3',
                'name' => 'Du Lịch',
                'slug' => 'du-lich',
                'description' => 'Tin Du lịch',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '4',
                'name' => 'Văn Hóa',
                'slug' => 'van-hoa',
                'description' => 'Tin Văn Hóa',
                'created_at' => Carbon::now(),
            ],
        ];
        DB::table('categories')->truncate();
        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        };
    }
}
