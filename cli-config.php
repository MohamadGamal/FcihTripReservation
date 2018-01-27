<?php
// cli-config.php
// require_once "bootstrap.php";
require_once __DIR__ . '/vendor/autoload.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet( Own\Bootstrap::getEntityManager());