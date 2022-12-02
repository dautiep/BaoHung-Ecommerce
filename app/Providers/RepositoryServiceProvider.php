<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\GroupRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Repositories\Interfaces\OtherFagRepositoryInterface;
use App\Repositories\Interfaces\QuestionAswerServiceInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\TypeOfServiceRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\OtherFagRepository;
use App\Repositories\QuestionAswerServiceRepository;
use App\Repositories\RoleRepository;
use App\Repositories\TypeOfServiceRepository;
use App\Repositories\UserRepository;
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
