<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Create categories
        $categories = [
            ['name' => 'Cakes', 'description' => 'Delicious cakes for all occasions.'],
            ['name' => 'Cupcakes', 'description' => 'Tasty and fun-sized cupcakes.'],
            ['name' => 'Cookies', 'description' => 'Freshly baked cookies with various flavors.'],
            ['name' => 'Pastries', 'description' => 'Flaky and buttery pastries.'],
        ];

        foreach ($categories as $category) {
            $cat = Category::create($category);

            // Create products for each category
            $products = [
                ['name' => 'Chocolate Cake', 'description' => 'Rich chocolate cake with creamy frosting.', 'price' => 25.00, 'stock' => 10, 'image' => 'chocolate_cake.jpg'],
                ['name' => 'Vanilla Cupcake', 'description' => 'Light and fluffy vanilla cupcakes.', 'price' => 3.00, 'stock' => 50, 'image' => 'vanilla_cupcake.jpg'],
                ['name' => 'Oatmeal Cookies', 'description' => 'Chewy oatmeal cookies with raisins.', 'price' => 1.50, 'stock' => 30, 'image' => 'oatmeal_cookies.jpg'],
                ['name' => 'Apple Pastry', 'description' => 'Sweet apple filling in a flaky pastry.', 'price' => 2.50, 'stock' => 20, 'image' => 'apple_pastry.jpg'],
            ];

            foreach ($products as $product) {
                Product::create(array_merge($product, ['category_id' => $cat->id]));
            }
        }
    }
}
