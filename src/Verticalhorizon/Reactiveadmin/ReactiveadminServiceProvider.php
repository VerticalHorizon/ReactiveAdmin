<?php namespace Verticalhorizon\Reactiveadmin;

use Illuminate\Support\ServiceProvider;

class ReactiveadminServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('verticalhorizon/reactiveadmin', 'reactiveadmin', __DIR__.'/../../');

        $this->app->setLocale(\Session::get('raa_locale', \Config::get('app.fallback_locale')));
        // $this->commands(
        //     'command.reactiveadmin.controller',
        //     'command.reactiveadmin.routes'
        // );

        //include __DIR__.'/../../filters.php';
        //include __DIR__.'/../../viewComposers.php';
        include __DIR__.'/../../routes.php';

        $this->app['events']->fire('reactiveadmin.ready');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['model_wrapper'] = $this->app->share(function($app)
        {
            return new ModelWrapper;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('model_wrapper');
    }

}
