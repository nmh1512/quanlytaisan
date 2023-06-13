<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (!function_exists('getYears')) {

    function getYears($startYear = null, $range = 100): array
    {
        $currentYear = $startYear ?: date('Y');
        $endYear = $currentYear - $range;
        $years = range($currentYear, $endYear);
        return $years;
    }
}


if (!function_exists('getRoutesByStarting')) {

    function getRoutesByStarting($start = '')
    {
        $list = Route::getRoutes()->getRoutesByName();
        if (empty($start)) {
            return $list;
        }

        foreach ($list as $name => $route) {
            if (Str::startsWith($name, $start)) {
                $routes[$name] = $route;
            }
        }
        return $routes;
    }
}
