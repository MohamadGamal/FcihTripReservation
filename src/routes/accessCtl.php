<?php

$entityManager=Own\Bootstrap::getEntityManager();

$this->respond('POST','/register',function ($request, $response, $service) use($entityManager){
    //   var_dump($route);

  try{  
    $body=json_decode($request->body());
    $user = new \Own\Entities\User();
    
    $user->setEmail($body->email);
    $user->setName($body->name);
    $user->setPassword(password_hash($body->password,PASSWORD_DEFAULT));
    $entityManager->persist($user);
    $entityManager->flush();
  }catch(Exception $err){

   return $response->json(['code'=>0,"message"=>$err->getMessage()]);
  }
  $response->json(['code'=>1,'message'=>"successfully registered"]);

   });
$this->respond('POST','/login',function ($request, $response, $service) use($entityManager){
    //   var_dump($route);

   try{  
      $body=json_decode($request->body());
      $user = $entityManager->getRepository('Own\Entities\User')->findOneBy(["email"=>$body->email]);
      if( $user && password_verify($body->password,$user->getPassword()))
      {
      
      $res= \Own\Helpers\Serializer::Json($user,["password","trips"]);
      $token=  \Own\Helpers\JWT::encode($res);
      return $response->json(["code" => 1 ,"message" =>$res,"token"=>$token]);  
      }
      return $response->code(400)->json(['code'=>2,'message'=>"bad combination of email/password"]);
    
    }catch(Exception $err){
  
     return $response->code(400)->json(['code'=>0,"message"=>$err->getMessage()]);
    }
    $response->json(['code'=>1,'message'=>"successfully registered"]);

   });