<?php
require_once __DIR__ . '/vendor/autoload.php';

$entityManager=Own\Bootstrap::getEntityManager();

$klein = new \Klein\Klein();

$klein->respond('GET', '/ds', function () {
    return 'Hello World!';
});
/*
$klein->respond(function ($route) {
 //   var_dump($route);
    return 'All things ﻷخخي';
});*/

$klein->with("/acl", "src/routes/accessCtl.php");
// $klein->with("/user", "src/routes/user.php");
$klein->with("/trip", "src/routes/trip.php");
$klein->with("/location", "src/routes/location.php");

$klein->dispatch();