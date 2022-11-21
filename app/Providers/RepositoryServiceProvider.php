<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Repositories\Interfaces\OtherFagRepositoryInterface;
use App\Repositories\Interfaces\QuestionAswerServiceInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\QuestionAswerServiceRepository;
use App\Repositories\TypeOfServiceRepository;
use Illuminate\Support\ServiceProvider;
use TypeOfServiceRepositoryInterface;

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
                'interface' => BaseRepositoryInterface::class,
                'repository'   => BaseRepository::class
            ],
            [
                'interface' => GroupRepositoryInterface::class,
                'repository' => GroupRepository::class,
            ],
            [
                'interface' => OtherFagRepositoryInterface::class,
                'repository' => OtherFagRepository::class,
            ],
            [
                'interface' => QuestionAswerServiceInterface::class,
                'repository' => QuestionAswerServiceRepository::class
            ],
            [
                'interface' => RoleRepositoryInterface::class,
                'repository' => RoleRepository::class
            ],
            [
                'interface' => TypeOfServiceRepositoryInterface::class,
                'repository' => TypeOfServiceRepository::class
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
