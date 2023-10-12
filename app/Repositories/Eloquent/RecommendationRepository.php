<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Models\Recommendation;
use App\Repositories\Contracts\RecommendationRepositoryInterface;

class RecommendationRepository implements RecommendationRepositoryInterface
{
    public function getRecommendedProducts(int $selectedOption): array
    {
        $productIds = Recommendation::where('option_id', $selectedOption)
            ->pluck('product_id')
            ->toArray();

        $products = Product::whereIn('id', $productIds)
            ->get(['id as productId', 'name as productName'])
            ->toArray();

        return $products;
    }
}
