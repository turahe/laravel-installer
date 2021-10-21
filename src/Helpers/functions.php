<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;

if (! function_exists('isActive')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param  array|string  $route
     * @param  string  $className
     * @return string
     */
    function isActive($route, $className = 'active'): string
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }
        if (Route::currentRouteName() == $route) {
            return $className;
        }
        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}
