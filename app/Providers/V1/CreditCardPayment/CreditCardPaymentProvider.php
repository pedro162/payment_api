<?php

namespace App\Providers\V1\CreditCardPayment;

use App\Infrastructure\Services\V1\Adapters\PagBank\CreditCardPayment as CreditCardPaymentInfraAdapter;
use App\Infrastructure\Services\V1\Facades\PagBank\CreditCardPayment as CreditCardPaymentInfraFacade;
use App\Infrastructure\Services\V1\Interfaces\CreditCardPayment\CreditCardPayment as CreditCardPaymentInfraInterface;
use App\Infrastructure\Services\V1\Interfaces\CreditCardPayment\CreditCardPaymentAdapter as CreditCardPaymentAdapterInfraInterface;
use Illuminate\Support\ServiceProvider;

class CreditCardPaymentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CreditCardPaymentInfraInterface::class, CreditCardPaymentInfraFacade::class);
        //$this->app->singleton(CreditCardPaymentAdapterInfraInterface::class, CreditCardPaymentInfraAdapter::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
