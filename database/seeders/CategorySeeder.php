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
        $category = new Category();
        $category->name = "Terror";
        $category->description = "Movies that scare";
        $category->save();

        $category = new Category();
        $category->name = "Comedy";
        $category->description = "Funny movies";
        $category->save(); 

        $category = new Category();
        $category->name = "Romance";
        $category->description = "Movies that cause feelings";
        $category->save();

        $category = new Category();
        $category->name = "Action";
        $category->description = "Movies that excite you";
        $category->save();

        $category = new Category();
        $category->name = "Drama";
        $category->description = "Movies that keep you on screen";
        $category->save();

        $category = new Category();
        $category->name = "Animation";
        $category->description = "Computer-made movies";
        $category->save();
    }
}
