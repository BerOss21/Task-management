<?php

namespace App\Providers;

use App\Models\Task;

use App\Policies\TaskPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

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
        JsonResource::withoutWrapping();
        
        // Route::bind('task', function (string $value) {
        //     return Auth::user()->tasks()->where('id', $value)->firstOrFail();
        // });

        Gate::policy(Task::class, TaskPolicy::class);
    }
}
