<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        Product::create(['name' => 'Laptop', 'description' => 'High-end laptop', 'price' => 1299.99, 'stock_quantity' => 10]);
        Product::create(['name' => 'Phone', 'description' => 'Wireless mouse', 'price' => 29.99, 'stock_quantity' => 15]);
        Product::create(['name' => 'Headphones', 'description' => 'Mechanical keyboard', 'price' => 89.99, 'stock_quantity' => 3]);
    }

}

