<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->setAutoRoute(true);
$routes->get("/article", "Article::show");
$routes->get("/article/(:num)", "Article::show/$1");
$routes->post("article/create","Article::create");