<?php

namespace AlgoWeb\ModelViews\Providers;

use AlgoWeb\ModelViews\Database\MysqlVirtualConnection;
use Illuminate\Database\Connectors\MySqlConnector;
use Illuminate\Database\MySqlConnection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class VirtualModelViewProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('db.connection.virtual', function ($app, $parameters) {
            list($connection, $database, $prefix, $config) = $parameters;
            return new MysqlVirtualConnection($connection, $database, $prefix, $config);
        });

        $this->app->singleton('db.connector.virtual', function ($app, $parameters) {
            return new MySqlConnector();
        });
    }
}
