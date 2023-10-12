<?php

namespace App\Repositories\Contracts;

interface RecommendationRepositoryInterface
{
    public function getRecommendedProducts(int $selectedOption): array;
}
