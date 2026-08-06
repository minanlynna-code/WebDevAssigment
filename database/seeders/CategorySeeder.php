<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Coffee',
                'description' => 'Freshly brewed coffee drinks',
            ],
            [
                'name' => 'Tea',
                'description' => 'Hot and iced tea',
            ],
            [
                'name' => 'Pastries',
                'description' => 'Fresh bakery items',
            ],
        ]);
    }
}