<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\GroupRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\ServiceRepository;
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
        $repositories = [
            [
                'interface' => GroupRepositoryInterface::class,
                'repository' => GroupRepository::class,
            ],
            [
                'interface' => ProductRepositoryInterface::class,
                'repository' => ProductRepository::class,
            ],
            [
                'interface' => CategoryRepositoryInterface::class,
                'repository' => CategoryRepository::class
            ],
            [
                'interface' => RoleRepositoryInterface::class,
                'repository' => RoleRepository::class
            ],
            [
                'interface' => ServiceRepositoryInterface::class,
                'repository' => ServiceRepository::class
            ],
            [
                'interface' => UserRepositoryInterface::class,
                'repository' => UserRepository::class,
            ],
            [
                'interface' => DepartmentRepositoryInterface::class,
                'repository' => DepartmentRepository::class
            ]
        ];

        foreach ($repositories as $instance) {
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
