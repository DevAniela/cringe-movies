<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use App\Models\Movie;
use App\Policies\MoviePolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     ** @var array
    */
    protected $policies = [
        Movie::class => MoviePolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        $this->registerPolicies();
    }
}
