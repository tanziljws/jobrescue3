<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($dbUrl = env('DB_URL')) {
            $parsed = parse_url($dbUrl);
            
            Config::set('database.connections.mysql.host', $parsed['host'] ?? null);
            Config::set('database.connections.mysql.port', $parsed['port'] ?? '3306');
            Config::set('database.connections.mysql.database', ltrim($parsed['path'] ?? '/', '/'));
            Config::set('database.connections.mysql.username', $parsed['user'] ?? '');
            Config::set('database.connections.mysql.password', $parsed['pass'] ?? '');
        }
    }
}
