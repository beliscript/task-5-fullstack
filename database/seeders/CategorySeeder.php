<?php

namespace Database\Seeders;

use App\Models\Category;
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
        Category::create([
            'name' => 'Php',
            'user_id' => random_int(1,2),
        ]);
        Category::create([
            'name' => 'Programming',
            'user_id' => random_int(1,2),
        ]);
        Category::create([
            'name' => 'HTML',
            'user_id' => random_int(1,2),
        ]);
        Category::create([
            'name' => 'Website',
            'user_id' => random_int(1,2),
        ]);
    }
}