<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'sildenafil_50' => 'Sildenafil 50mg',
            'sildenafil_100' => 'Sildenafil 100mg',
            'tadalafil_10' => 'Tadalafil 10mg',
            'tadalafil_20' => 'Tadalafil 20mg',
        ];

        foreach ($products as $id => $name) {
            Product::create([
                'id' => $id,
                'name' => $name,
            ]);
        }
    }
}
