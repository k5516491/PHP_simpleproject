<?php
namespace Admin\Config;
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */
//演示group namespace 用法
//演示filter: group用法 
$routes->group("admin", ["namespace"=> "Admin\Controllers", "filter"=> "group:Admin"], function (RouteCollection $routes) {
    $routes->get("user","User::index");
    $routes->get("user/(:num)","User::show/$1");
    $routes->match(["get","post"],"user/(:num)/group","User::group/$1");
});