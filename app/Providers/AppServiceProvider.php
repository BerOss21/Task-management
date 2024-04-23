<?php

namespace App\Providers;

use App\Models\Task;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        Route::bind('task', function (string $value) {
            return Auth::user()->tasks()->where('id', $value)->firstOrFail();
        });
    }
}
