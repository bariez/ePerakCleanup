<?php

namespace Workbench\Site;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App\Enums\Permission;
use DB;
use Workbench\Asset\AssetManager;

/**
 * Class PackageServiceProvider
 *
 * @see http://laravel.com/docs/master/packages#service-providers
 * @see http://laravel.com/docs/master/providers
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @see http://laravel.com/docs/master/providers#deferred-providers
     * @var bool
     */
    protected $defer = false;

   /**
     * Register the service provider.
     *
     * @see http://laravel.com/docs/master/providers#the-register-method
     * @return void
     */
    protected $listen = [
        
        \Workbench\Site\Events\EmailEvent::class => [
            \Workbench\Site\Handlers\Events\SentEmail::class
        ],
    ];


    public function register()
    {
        if ((!$this->app->runningInConsole()) || $this->app->runningUnitTests()) {
            $this->registerAssets();
        }
    }

    /**
     * Application is booting
     *
     * @see http://laravel.com/docs/master/providers#the-boot-method
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'site');
        $this->menu();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    }

    protected function registerAssets()
    {
        if (!$this->app->bound('laravolt.asset.group.laravolt')) {
            $this->app->singleton(
                'laravolt.asset.group.laravolt',
                function () {
                    return new AssetManager(
                        [
                            'public_dir' => public_path('laravolt'),
                            'css_dir' => '',
                            'js_dir' => '',
                        ]
                    );
                }
            );
        }
    }

    protected function menu()
    {

        //$menu = $this->app['laravolt.menu']->add(__('Dashboard'))->data('icon', 'clipboard list');
        //$menu->add(__('Dashboard Individu'), url('/index/'))
        //     ->data('icon', 'clipboard list')
        //     ->active('index/*')


        //$menu->add(__('Dashboard Tindakan'), url('dashboard/list/5'))
        //     ->data('icon', 'grid layout')
        //     ->active('dashboard/list/5')
        //     ->active('appl/views/*')
        //     ->data('permission', Permission::DASHBOARD_TINDAKAN);

       
    }
}