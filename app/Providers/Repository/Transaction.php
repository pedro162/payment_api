<?php

namespace App\Providers\Repository;

use App\Infrastructure\Repository\Eloquent\Transaction\TransactionRepository;
use App\Infrastructure\Repository\Interfaces\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class Transaction extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(TransactionRepositoryInterface::class, TransactionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
