<?php

namespace App\Providers\V1\QRCodePayment;

use App\Infrastructure\Services\V1\Adapters\PagBank\QRCodePayment as QRCodePaymentInfraAdapter;
use App\Infrastructure\Services\V1\Facades\PagBank\QRCodePayment as QRCodePaymentInfraFacade;
use App\Infrastructure\Services\V1\Interfaces\QRCodePayment\QRCodePayment as QRCodePaymentInfraInterface;
use App\Infrastructure\Services\V1\Interfaces\QRCodePayment\QRCodePaymentAdapter as QRCodePaymentAdapterInfraInterface;
use Illuminate\Support\ServiceProvider;

class QRCodePaymentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(QRCodePaymentInfraInterface::class, QRCodePaymentInfraFacade::class);
        //$this->app->singleton(QRCodePaymentAdapterInfraInterface::class, QRCodePaymentInfraAdapter::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
