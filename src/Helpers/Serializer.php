<?php namespace Own\Helpers;

class Serializer{


static function Json($data,$execlude=[]){


    $serializer= \JMS\Serializer\SerializerBuilder::create()->build();
    $jsonContent = $serializer->serialize($data, 'json');
    $jsonObj=json_decode($jsonContent);
    foreach ($execlude as  $value) {
        unset($jsonObj->$value);
    }
   return $jsonObj;

}


}