<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    protected function getData(): array
    {
        $data = [];

        $generator = Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'title' => $generator->sentence(),
                'content' => $generator->text(),
                'category_id' => $generator->randomElement(array_column(\App\Category::all(), 'id')),
                'image' => asset('storage/default.jpg'),
                'date' => $generator->date(),
            ];
        }

        return $data;
    }
}
