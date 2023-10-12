<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecommendationRequest;
use App\Models\Option;
use App\Repositories\Contracts\RecommendationRepositoryInterface;


class RecommendationController extends Controller
{
    protected RecommendationRepositoryInterface $recommendationRepository;

    public function __construct(RecommendationRepositoryInterface $recommendationRepository)
    {
        $this->recommendationRepository = $recommendationRepository;
    }

    public function getRecommendations(RecommendationRequest $request): \Illuminate\Http\JsonResponse
    {
          $validated = $request->validated();
        $selectedOptions = $request->input('userOption');

        $noRecommendationOption = Option::where('id', $selectedOptions)
            ->where('recommendation_allowed', false)
            ->first();

        if ($noRecommendationOption) {
            return response()->json(['message' => 'No products available.','status' => false, 'data'=>[]], 200);
        }

        $recommendedProducts = $this->recommendationRepository->getRecommendedProducts($selectedOptions);

        return response()->json(['message' => 'Recommendations found.','status' => true, 'data' => $recommendedProducts], 200);
    }


}
