<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        // Safety net: ensure cache store does not require DB in fresh envs/POC
        $useSqliteForPoc = filter_var(env('USE_SQLITE_FOR_POC', false), FILTER_VALIDATE_BOOL);
        $explicitCache = env('CACHE_STORE', env('CACHE_DRIVER'));
        if (is_string($explicitCache)) {
            $explicitCache = trim($explicitCache, "\"' ");
        }

        // If explicitly set to database but DB may be unavailable during boot, switch to file
        if ($useSqliteForPoc || !$explicitCache || Str::lower((string) $explicitCache) === 'database') {
            config(['cache.default' => 'file']);
        }
    }
}
