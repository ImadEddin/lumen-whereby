<?php

namespace Whereby;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * Description of WherebyServiceProvider
 *
 * @author Adel Jerbi <adel.jerbi@we-conect.com>
 */
class WherebyServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the configuration
     *
     * @return void
     */
    public function boot() {
        if ($this->app instanceof LumenApplication) {
            $this->app->configure('whereby');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(
                __DIR__ . '/config/whereby.php', 'whereby'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['whereby'];
    }

}
