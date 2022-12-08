<?php

namespace App\Providers;

use App\ShortCode\DownloadButtonShortCode;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Shortcode;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Shortcode::register(DownloadButtonShortCode::short_code_name, DownloadButtonShortCode::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }
}
