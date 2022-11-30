<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AdminRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Interfaces\VendorRepositoryInterface;
use App\Repositories\VendorRepository;
use App\Interfaces\DashboardRepositoryInterface;
use App\Repositories\DashboardRepository;
use App\Interfaces\UserRepositoryInterface;
Use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
