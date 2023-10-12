<?php

namespace App\Providers;

use App\Repositories\Contracts\QuestionnaireRepositoryInterface;
use App\Repositories\Contracts\RecommendationRepositoryInterface;
use App\Repositories\Eloquent\QuestionnaireRepository;
use App\Repositories\Eloquent\RecommendationRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            QuestionnaireRepositoryInterface::class,
            QuestionnaireRepository::class
        );

        $this->app->bind(
            RecommendationRepositoryInterface::class,
            RecommendationRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Inertia::share('flash', function () {
            return [
                'message' => Session::get('message'),
                'error' => Session::get('error'),
            ];
        });
    }
}
