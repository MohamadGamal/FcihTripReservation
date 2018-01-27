<?php 
require_once __DIR__ . '/vendor/autoload.php';

$entityManager=Own\Bootstrap::getEntityManager();
use \Own\Entities\User as OUser;
use \Own\Entities\Trip as OTrip;
use \Own\Entities\Location as OLocation;
/*
Locations
*/
$location=new OLocation();
$location->setName("cairo");
$entityManager->persist($location);
$location=new OLocation();
$location->setName("Alexandria");
$entityManager->persist($location);
$location=new OLocation();
$location->setName("London");
$entityManager->persist($location);
$location=new OLocation();
$location->setName("Paris");
$entityManager->persist($location);
$entityManager->flush();

/*
Trips
*/
$locationto=$entityManager->getRepository('Own\Entities\Location')->findOneBy(["name"=>"cairo"]);
$locationfrom=$entityManager->getRepository('Own\Entities\Location')->findOneBy(["name"=>"Alexandria"]);
$date= DateTime::createFromFormat('j-M-Y', '17-Feb-2018');
$trip=new OTrip();
$trip->setFrom($locationfrom);
$trip->setTo($locationto);
$trip->setTime($date);
$trip->setSeats(20);
$entityManager->persist($trip);

$date= DateTime::createFromFormat('j-M-Y', '10-Feb-2018');
$trip=new OTrip();
$trip->setFrom($locationto);
$trip->setTo($locationfrom);
$trip->setTime($date);
$trip->setSeats(15);
$entityManager->persist($trip);


$locationfrom=$entityManager->getRepository('Own\Entities\Location')->findOneBy(["name"=>"London"]);
$date= DateTime::createFromFormat('j-M-Y', '15-Feb-2018');
$trip=new OTrip();
$trip->setFrom($locationto);
$trip->setTo($locationfrom);
$trip->setTime($date);
$trip->setSeats(25);
$entityManager->persist($trip);

$date=DateTime::createFromFormat('j-M-Y', '22-Feb-2018');
$trip=new OTrip();
$trip->setFrom($locationfrom);
$trip->setTo($locationto);
$trip->setTime($date);
$trip->setSeats(22);
$entityManager->persist($trip);

$locationfrom=$entityManager->getRepository('Own\Entities\Location')->findOneBy(["name"=>"Paris"]);
$date= DateTime::createFromFormat('j-M-Y', '15-Feb-2018');
$trip=new OTrip();
$trip->setFrom($locationto);
$trip->setTo($locationfrom);
$trip->setTime($date);
$trip->setSeats(31);
$entityManager->persist($trip);

$date=DateTime::createFromFormat('j-M-Y', '22-Feb-2018');
$trip=new OTrip();
$trip->setFrom($locationfrom);
$trip->setTo($locationto);
$trip->setTime($date);
$trip->setSeats(75);
$entityManager->persist($trip);


/*
$location=new OTrip();
$location->setName("Alexandria");
$entityManager->persist($location);
$location=new OTrip();
$location->setName("London");
$entityManager->persist($location);
$location->setName("Paris");
$entityManager->persist($location);
*/
$entityManager->flush();
