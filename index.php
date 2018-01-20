<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
require_once __DIR__ . '/vendor/autoload.php';
$klein = new \Klein\Klein();

$klein->respond('GET', '/ds', function () {
    return 'Hello World!';
});
$klein->respond(function ($route) {
 //   var_dump($route);
    return 'All things ﻷخخي';
});

$klein->respond('GET','/jsonOn',function ($request, $response, $service) {
    //   var_dump($route);
    $response->json([3,"que"=>2,4,5]);
    
   });
   
/*
$klein->respond('GET','/info',function ($route) {
    phpinfo();

       return;
   });
*/
   $klein->dispatch();