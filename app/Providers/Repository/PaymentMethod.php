<?php

namespace App\Providers\Repository;

use App\Infrastructure\Repository\Eloquent\PaymentMethod\PaymentMethodRepository;
use App\Infrastructure\Repository\Interfaces\PaymentMethod\PaymentMethodRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class PaymentMethod extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
