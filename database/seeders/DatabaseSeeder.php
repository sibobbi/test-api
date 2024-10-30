<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        Category::factory(5)->create()->each(function ($category) {
            Category::factory(2)->create(['category_id' => $category->id, 'sort_number' => 0])->each(function ($subCategory) {
                Category::factory(2)->create(['category_id' => $subCategory->id, 'sort_number' => 0]);
            });
        });

        Product::factory(50)->create();

        Order::factory(100)->create();
    }

}
