<?php
namespace Admin\Config;
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */
//service('admin')->routes($routes); //for shield
//$routes->setAutoRoute(true);
$routes->group("admin", ["namespace"=> "Admin\Controllers", "filter"=> "group:Admin"], function (RouteCollection $routes) {
    $routes->get("user","User::index");

});