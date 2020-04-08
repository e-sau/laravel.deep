<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            [
                'title' => 'Политика',
                'slug' => 'politics'
            ],
            [
                'title' => 'Спорт',
                'slug' => 'sport'
            ],
        ]);
    }
}
