<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);
$routes->get('/', 'Article::index');

service('auth')->routes($routes); //for shield

$routes->group("", ['filter'=> 'login'], static function ($routes) {
    $routes->get("set-password","Password::show"); //顯示變更密碼畫面
    $routes->post("set-password","Password::update"); //上傳密碼
    $routes->get("/article", "Article::index"); //主頁，顯示全部當前文章
    $routes->get("article/create","Article::create"); //新增頁面，上傳資料

    $routes->get("article/Update/(:num)","Article::show/$1"); //顯示修改頁面
    $routes->post("article/Update","Article::Update"); //修改頁面

    $routes->get("article/delete","Article::Delete"); //顯示刪除文章頁面

    $routes->get("article/Image","Article::Image"); //顯示上傳圖片頁面
    $routes->post("article/Image/Create","Article::ImageCreate"); //上傳圖片

    $routes->get("article/Image/show","Article::showImage"); //顯示圖片
    $routes->get("article/Image/delete","Article::ImageDelete"); //刪除圖片
});    
//$routes->resource("article");
//$routes->get("/article/(:num)", "Article::show/$1");
