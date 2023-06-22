<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(
            \App\Repositories\Order\OrderRepositoryInterface::class,
            \App\Repositories\Order\OrderRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Role\RoleRepositoryInterface::class,
            \App\Repositories\Role\RoleRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Supplier\SupplierRepositoryInterface::class,
            \App\Repositories\Supplier\SupplierRepository::class
        );

        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CategoryAssets\CategoryAssetsRepositoryInterface::class,
            \App\Repositories\CategoryAssets\CategoryAssetsRepository::class
        );

        $this->app->singleton(
            \App\Repositories\TypeAssets\TypeAssetsRepositoryInterface::class,
            \App\Repositories\TypeAssets\TypeAssetsRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
