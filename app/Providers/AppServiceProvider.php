<?php

namespace App\Providers;

use App\User;
use App\Offer;
use App\Observers\OfferObserver;
use App\Product;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\View;
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

        // Offer::observe(OfferObserver::class);

        config(['app.locale' => 'id']);
        \Carbon\Carbon::setLocale('id');

        view()->share('users', User::select('id', 'name')->get());
        view()->share('readyToApprove', Offer::readyToApproveCount());
        view()->share('readyToPurchase', Offer::readyToPurchaseCount());
        view()->share('products', Product::get());
        view()->share('preloadingQuoute', Inspiring::quote());
    }
}
