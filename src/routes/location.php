<?php

$entityManager=Own\Bootstrap::getEntityManager();

$this->respond('*',function ($request, $response, $service) use($entityManager){
try{

$head= $request->headers()->get("Authorization");
$token=explode(" ",$head)[1];
if(empty($token))
  throw new Exception("Bad String");
//var_dump(\Own\Helpers\JWT::decode($token));
$service->currentUser=\Own\Helpers\JWT::decode($token)->data;
$service->currentUserActual=$entityManager->getRepository('Own\Entities\User')
                                          ->findOneBy(["id"=>$service->currentUser->id]);




}
catch(Exception $e){
 // var_dump($e->getMessage());
  $response->code(401)->json(['code'=>0,"message"=>"Not Authorized to Acess"]);
die;

}
});
$this->respond('GET','/',function ($request, $response, $service) use($entityManager){
  try{  
    $locations=$entityManager->getRepository('Own\Entities\Location')->findAll();
    $res=[];
    foreach($locations as $loc)
      $res[]=\Own\Helpers\Serializer::Json($loc ,["froms","tos"]);
  
    return $response->json(['code'=>1,'data'=>$res]);
  }catch(Exception $err){

   return $response->json(['code'=>0,"message"=>$err->getMessage()]);
  }


   });