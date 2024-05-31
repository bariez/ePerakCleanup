<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
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
        $this->app->singleton('laravolt.menu.sidebar', function () {
            return new Menu();
        });

        $this->app->singleton('laravolt.menu.builder', function (Application $app) {
            return $app->make(MenuBuilder::class);
        });

        app('laravolt.menu.sidebar')->register(function ($menu) {
            $menu->add('System')->data('order', config('laravolt.ui.system_menu.order') + 1);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app('laravolt.menu.sidebar')->register(function ($menu) {
            $config = get_user_sidebar_menu(auth()->user());

            foreach ($config as $key => $value) {
                $group = $menu->add($key)
                    ->data('order', data_get($value, 'order'));
                foreach (data_get($value, 'menu', []) as $k => $v) {
                    $group->add($k, route(data_get($v, 'route')))
                ->active(data_get($v, 'active'))
                ->data('icon', data_get($v, 'icon'));
                }
            }
        });
    }
}
