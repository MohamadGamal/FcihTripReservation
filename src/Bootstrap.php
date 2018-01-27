<?php namespace Own;


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// bootstrap.php
class Bootstrap{
    static private $entityManager;
    static function getEntityManager(){
        if(is_null(self::$entityManager)){
            $isDevMode = true;
            $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/Entities"), $isDevMode,null,null,false);
            // or if you prefer yaml or XML
            //$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
            //$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);
            
            // database configuration parameters
            $conn = array(
                'dbname' => 'newa',
                'user' => 'root',
                'password' => 'passwd',
                'host' => '172.17.0.3',
                'driver' => 'pdo_mysql',
            );
            
            // obtaining the entity manager
            self::$entityManager = EntityManager::create($conn, $config);


        }
        return self::$entityManager;
    }
}