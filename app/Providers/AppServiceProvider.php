<?php

namespace App\Providers;

use App\Application\Handlers\CreatePersonHandler;
use App\Application\Handlers\InfoPersonHandler;
use App\Application\Services\PersonApplicationService;
use App\Domain\Person\Repositories\PersonRepositoryInterface;
use App\Infrastructure\Persistence\EloquentPersonRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Binding interfaces to implementations
        //$this->app->bind(PersonRepositoryInterface::class, EloquentPersonRepository::class);

        // Binding the handlers
        $this->app->bind(CreatePersonHandler::class, function ($app) {
            return new CreatePersonHandler($app->make(EloquentPersonRepository::class));
        });

        $this->app->bind(PersonApplicationService::class, function ($app) {
            return new PersonApplicationService(
                $app->make(CreatePersonHandler::class),
                $app->make(InfoPersonHandler::class),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::pattern('id', '[0-9]+');
    }
}
