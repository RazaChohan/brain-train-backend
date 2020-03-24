<?php

namespace App\Providers;

use Dal\Interfaces\UserRepository;
use Dal\Repositories\UserRepositoryImpl;
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
        //Bind all interfaces with repositories
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
    }
}
