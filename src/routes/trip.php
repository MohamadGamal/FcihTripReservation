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
//  var_dump($e->getMessage());
  $response->code(401)->json(['code'=>0,"message"=>"Not Authorized to Acess"]);
die;

}
});
$this->respond('GET','/[i:id]',function ($request, $response, $service) use($entityManager){
  try{  

    
    $location=$entityManager->getRepository('Own\Entities\Location')->findOneBy(["id"=>$request->id]);
    if(empty($location))
                 throw new Exception("Location Not Found");
    $trips=[];
    
   
    forEach( $location->getFroms() as $trip)
    {
    
      if( ! ( count($trip->getUsers())>=$trip->getSeats() ||   $service->currentUserActual->getTrips()->contains($trip) ) )
              $trips[]=$trip;        

    }
   
   
    $res= \Own\Helpers\Serializer::Json($trips);
    return $response->json(['code'=>1,'data'=>$res]);
  }catch(Exception $err){

   return $response->json(['code'=>0,"message"=>$err->getMessage()]);
  }


   });
$this->respond('POST','/[i:id]',function ($request, $response, $service) use($entityManager){
  try{  

    
    $trip=$entityManager->getRepository('Own\Entities\Trip')->findOneBy(["id"=>$request->id]);
    if(empty($trip))
                 throw new Exception("Trip Not Found");
    if(  count($trip->getUsers())>=$trip->getSeats())
                 throw new Exception("Trip Already At Full Capacity");
    $service->currentUserActual->addTrip($trip);
    $entityManager->flush();

    return $response->json(['code'=>1,'message'=>"successfully added"]);
  }catch(Exception $err){

   return $response->json(['code'=>0,"message"=>$err->getMessage()]);
  }


   });
$this->respond('DELETE','/[i:id]',function ($request, $response, $service) use($entityManager){
    try{  
  
      
      $trip=$entityManager->getRepository('Own\Entities\Trip')->findOneBy(["id"=>$request->id]);
      if(empty($trip))
                    throw new Exception("Trip Not Found");
      if(  count($trip->getUsers())>=$trip->getSeats())
                   throw new Exception("Trip Already At Full Capacity");
      $service->currentUserActual->removeTrip($trip);
      $entityManager->flush();
  
      return $response->json(['code'=>1,'message'=>"successfully deleted"]);
    }catch(Exception $err){
  
     return $response->json(['code'=>0,"message"=>$err->getMessage()]);
    }
  
  
     });
$this->respond('PUT','/[i:oldId]/[i:newId]',function ($request, $response, $service) use($entityManager){
      try{  
    
        
        $newTrip=$entityManager->getRepository('Own\Entities\Trip')->findOneBy(["id"=>$request->newId]);
        $oldTrip=$entityManager->getRepository('Own\Entities\Trip')->findOneBy(["id"=>$request->oldId]);
        if(empty($newTrip)|| empty($oldTrip))
                      throw new Exception("Trip Not Found");
        if(  count($newTrip->getUsers())>=$newTrip->getSeats())
                     throw new Exception("Trip Already At Full Capacity");
        $service->currentUserActual->removeTrip($oldTrip);
        $service->currentUserActual->addTrip($newTrip);
        $entityManager->flush();
    
        return $response->json(['code'=>1,'message'=>"successfully replaced"]);
      }catch(Exception $err){
    
       return $response->json(['code'=>0,"message"=>$err->getMessage()]);
      }
    
    
       });
     
