<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repository = [
            [
                'interface' => BaseRepositoryInterface::class,
                'repository'   => BaseRepository::class
            ]
        ];
        foreach ($repository as $instance) {
            $this->app->bind(
                $instance['interface'],
                $instance['repository']
            );
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
