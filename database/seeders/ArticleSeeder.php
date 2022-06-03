<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <100 ; $i++) { 
            Article::create([
                'title' => 'Title Tester '.$i.'',
                'content' => 'Konten '.$i.' lorem ',
                'image' => 'dummy.png',
                'category_id' => random_int(1,3),
                'user_id' => random_int(1,2),
            ]);
        }
    }
}