<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravolt\Platform\Http\Middleware\FlashMiddleware;
use Laravolt\Platform\Services\Flash;
use Laravolt\Platform\Services\Menu;
use Laravolt\Platform\Services\MenuBuilder;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->booted(function () {
            if (auth()->check()) {
                $this->bootMenu();
            }
        });


    }

    private function bootMenu()
    {

        $this->app->singleton('laravolt.menu.sidebar', function () {
            return new Menu();
        });

        $this->app->singleton('laravolt.menu.builder', function (Application $app) {
            return $app->make(MenuBuilder::class);
        });
        $config = ! auth()->check() ? [] : get_user_sidebar_menu(auth()->user());

        if(auth()->check()) {
            dd($config);
        }

        $this->app['laravolt.menu.builder']->loadArray($config);

        View::composer('laravolt::menu.sidebar', function () {
            $menuDir = base_path('menu');
            if (is_dir($menuDir)) {
                foreach (new \FilesystemIterator($menuDir) as $file) {
                    $menu = include $file->getPathname();
                    $this->app['laravolt.menu.builder']->loadArray($menu);
                }
            }
            $this->app['laravolt.menu.builder']->runCallbacks();
        });

        // // We add default menu in register() method,
        // // to make sure it is always accessible by other providers.
        // app('laravolt.menu.sidebar')->register(function ($menu) {
        //     $menu->add('Modules')->data('order', config('laravolt.ui.system_menu.order'));
        // });
        // app('laravolt.menu.sidebar')->register(function ($menu) {
        //     $menu->add('System')->data('order', config('laravolt.ui.system_menu.order') + 1);
        // });

        // if (! $this->app->bound('stolz.assets.group.laravolt')) {
        //     $this->app->singleton('stolz.assets.group.laravolt', function () {
        //         return new Manager([
        //             'public_dir' => public_path('laravolt'),
        //             'css_dir' => '',
        //             'js_dir' => '',
        //         ]);
        //     });
        // }

        // \Stolz\Assets\Laravel\Facade::group('laravolt')
        //     ->registerCollection(
        //         'vegas',
        //         [
        //             'laravolt/plugins/vegas/vegas.min.css',
        //             'laravolt/plugins/vegas/vegas.min.js',
        //         ]
        //     )->registerCollection(
        //         'autoNumeric',
        //         [
        //             'laravolt/plugins/autoNumeric.min.js',
        //         ]
        //     );

        // $this->app->singleton('laravolt.flash', function (Application $app) {
        //     return $app->make(Flash::class);
        // });

        // $this->app->singleton(FlashMiddleware::class, function (Application $app) {
        //     return new FlashMiddleware($app['laravolt.flash']);
        // });
    }
}
