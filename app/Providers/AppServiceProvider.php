<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\AdminMiddleware;

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
        Gate::define('admin', function (User $user) {
            $allowedEmails = ['gondarsb@gmail.com', 'gondarahmadhaidar@gmail.com']; 
            return in_array($user->email, $allowedEmails);
        });
        Route::middleware('admin', AdminMiddleware::class);
        
    }
}
