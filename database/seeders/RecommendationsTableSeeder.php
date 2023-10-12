<?php

namespace Database\Seeders;

use App\Models\Recommendation;
use Illuminate\Database\Seeder;

class RecommendationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recommendation::create([
            'option_id' => 6,
            'product_id' => 'sildenafil_50'
        ]);

        Recommendation::create([
            'option_id' => 6,
            'product_id' => 'tadalafil_10'
        ]);

        Recommendation::create([
            'option_id' => 7,
            'product_id' => 'tadalafil_10'
        ]);

        Recommendation::create([
            'option_id' => 8,
            'product_id' => 'sildenafil_100'
        ]);

        Recommendation::create([
            'option_id' => 9,
            'product_id' => 'sildenafil_100'
        ]);

        Recommendation::create([
            'option_id' => 10,
            'product_id' => 'tadalafil_20'
        ]);

        Recommendation::create([
            'option_id' => 11,
            'product_id' => 'tadalafil_20'
        ]);

        Recommendation::create([
            'option_id' => 11,
            'product_id' => 'sildenafil_100'
        ]);

    }
}
