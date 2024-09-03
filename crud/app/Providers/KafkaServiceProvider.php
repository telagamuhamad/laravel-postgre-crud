<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RdKafka\Producer;

class KafkaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Producer::class, function($app) {
            $config = new \RdKafka\Conf;
            $config->set('metadata.broker.list', env('kafka.brokers'));
            return new Producer($config);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
