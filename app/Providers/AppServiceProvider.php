<?php

namespace App\Providers;

use App\Offer;
use App\Observers\OfferObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('currency', function ($expression) {
            return "Rp <?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        Offer::observe(OfferObserver::class);
    }
}
