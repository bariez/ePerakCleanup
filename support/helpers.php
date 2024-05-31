<?php

use App\User;

if(! function_exists('get_user_sidebar_menu')) {
    function get_user_sidebar_menu(User $user)
    {
        return collect(config('menu'))->map(function($group, $group_label) use ($user) {
            $menu = collect($group['menu'])->reject(function($value, $key) use ($user) {
                return $user->can($value['permission']) === false;
            });
            $group['menu'] = $menu->toArray();

            return $group;
        })->reject(function($group) {
            return count($group['menu']) === 0;
        })->toArray();
    }
}
