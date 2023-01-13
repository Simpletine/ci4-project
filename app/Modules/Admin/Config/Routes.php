<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('admin', ['namespace' => 'App\Modules\Admin\Controllers'], function ($subroutes) {

    /*** Route for Dashboard ***/
    $subroutes->add('', 'Dashboard::index');
    $subroutes->add('dashboard', 'Dashboard::index');
    $subroutes->add('login', 'Dashboard::login');
    $subroutes->add('table', 'Table::table');
    $subroutes->add('table/new', 'Table::table/new');
    $subroutes->add('table/new/0', 'Table::table/new');
    $subroutes->add('table/edit/(:segment)', 'Table::table/edit/$1');
    $subroutes->add('table/delete/(:segment)', 'Table::table/delete/$1');
    $subroutes->add('logout', 'Dashboard::logout');
    
});
