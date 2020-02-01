<?php

namespace Valadanchik\BlockChain;

use Illuminate\Support\ServiceProvider;
use anlutro\cURL\cURL;
use Valadanchik\BlockChain\Payments\BlockChain;

class BlockChainServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/blockchain.php' => config_path('blockchain.php')
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('BlockChain', function()
        {
            return new BlockChain(new cURL());
        });
    }


}
