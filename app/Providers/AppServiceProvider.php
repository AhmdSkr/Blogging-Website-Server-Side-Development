<?php

namespace App\Providers;

use App\Services\FileCollectionService;
use App\Services\SimpleFileCollectionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(FileCollectionService::class, SimpleFileCollectionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
