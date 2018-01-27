<?php namespace Own\Helpers;

use \Firebase\JWT\JWT as FJWT;
class JWT{


static function encode($data){
    $jwt=["data"=>(array)$data];
    $jwt["exp"]        = time() + (60 * 60 * 4);
    $jwt["iat"]        = time();
   $jwt = FJWT::encode($jwt, "mysupersecretkey");
   return $jwt;

}

static function decode($jwt){
   $data= FJWT::decode($jwt,"mysupersecretkey", array('HS256'));
   return $data;

}



}