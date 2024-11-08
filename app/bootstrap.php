<?php

define ('appRoot', dirname(__file__)) ; //C:\xampp\htdocs\codeigniter4\app
define ('URLRoot', 'http://localhost/codeigniter4');

//require_once dirname(appRoot).'\vendor\autoload.php';
// \Config\Database::bootEloquent();
//自動require libraries裡的php
spl_autoload_register(function ($class) {
    //require_once (appRoot . '\Libraries\ ' . $class .'\php');
});
    
