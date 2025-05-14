<?php

namespace App\Providers;
use App\Models\Office;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        //
        // $offices = Office::all();
        // View::share('office', Office::first());

            if (Schema::hasTable('offices')) {
        $offices = Office::all(); // ✅ safe check
    }
    }
}
