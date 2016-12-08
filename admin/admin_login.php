<?php

include_once("../user.php");

if(isset($_REQUEST['username'])){
  $username=$_REQUEST['username'];
  $password=$_REQUEST['password'];

  $obj= new user();
  $row=$obj->login_admin($username, $password);
  $results=$obj->fetch();
  if(!$results){
    echo " unsuccessful";

    return;
  }
  else{
    $details= $username." successfully logged into POKAZ admin portal";
    $obj->generatereport($details);
    echo "Successful";
    header("location: adminhome.html");
}


}


 ?>
