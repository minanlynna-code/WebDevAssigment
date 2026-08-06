<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Latte',
            'description' => 'Espresso with steamed milk.',
            'price' => 2.50,
            'image' => 'latte.jpg',
            'stock' => 20,
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Americano',
            'description' => 'Espresso with hot water.',
            'price' => 2.00,
            'image' => 'americano.jpg',
            'stock' => 15,
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Cappuccino',
            'description' => 'Espresso with milk foam.',
            'price' => 3.00,
            'image' => 'cappuccino.jpg',
            'stock' => 18,
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Green Tea',
            'description' => 'Fresh green tea.',
            'price' => 1.80,
            'image' => 'greentea.jpg',
            'stock' => 25,
        ]);
                Product::create([
            'category_id' => 1,
            'name' => 'Latte',
            'description' => 'Espresso with steamed milk.',
            'price' => 2.50,
            'image' => 'latte.jpg',
            'stock' => 20,
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Americano',
            'description' => 'Espresso with hot water.',
            'price' => 2.00,
            'image' => 'americano.jpg',
            'stock' => 15,
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Cappuccino',
            'description' => 'Espresso with milk foam.',
            'price' => 3.00,
            'image' => 'cappuccino.jpg',
            'stock' => 18,
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Green Tea',
            'description' => 'Fresh green tea.',
            'price' => 1.80,
            'image' => 'greentea.jpg',
            'stock' => 25,
        ]);

                Product::create([
            'category_id' => 1,
            'name' => 'Cappuccino',
            'description' => 'Espresso with milk foam.',
            'price' => 3.00,
            'image' => 'cappuccino.jpg',
            'stock' => 18,
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Green Tea',
            'description' => 'Fresh green tea.',
            'price' => 1.80,
            'image' => 'greentea.jpg',
            'stock' => 25,
        ]);
    }
}
