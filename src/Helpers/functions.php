<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('set_active')) {

    /**
     * Menambahkan CSS class active Pada Menu Sesuai Route yang di Akses di Laravel 5.
     *
     * https://medium.com/laravel-indonesia/menambahkan-css-class-active-pada-menu-sesuai-route-yang-di-akses-di-laravel-5-d0d35e91a7fd
     *
     *
     * @param $uri
     * @param  string  $output
     * @return string
     */
    function set_active($uri, $output = 'active')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)) {
                return $output;
            }
        }
    }
}
