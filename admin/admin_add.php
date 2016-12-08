<?php

include_once("../user.php");

if(isset($_REQUEST['name'])){
  $name=$_REQUEST['name'];
  $tel=$_REQUEST['tel'];
  $location= $_REQUEST['location'];
  $feature_type=$_REQUEST['type'];
  $lat=$_REQUEST['lat'];
  $long=$_REQUEST['long'];

$obj= new user();
  $row=$obj->addfeature($name, $tel, $location, $lat,$long, $feature_type);
  
  if($row==0){
    echo " unsuccessful";

    return;
  }
  else{

    echo "Successful";
    header("location: adminhome.html");
}


}


 ?>
