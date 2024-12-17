<?php

namespace App\Providers;

use App\Application\Handlers\CreatePersonHandler;
use App\Application\Handlers\InfoPersonHandler;
use App\Application\Services\PersonApplicationService;
use App\Domain\Person\Repositories\PersonRepositoryInterface;
use App\Infrastructure\Persistence\EloquentPersonRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Binding interfaces to implementations
        //Passport::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::pattern('id', '[0-9]+');

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
