<?php

include_once("adb.php");

class user extends adb{
  function user(){

  }


  function Signup( $firstname, $lastname,$username,$tel, $password){
    $strQuery="Insert into User set fname='$firstname', lname='$lastname',username= '$username', tel='$tel',password= MD5('$password')";

    return $this->query($strQuery);
  }

  function checkUsername($username)
  {
    $strQuery="Select * from User where username like '$username'";
    return $this->query($strQuery);


  }

  function Login($username,$password){
   $strQuery="Select * from User where username = '$username' and password='$password'";

      return $this->query($strQuery);

  }

  function generatereport($details){
    $strQuery="Insert into report set details='$details'";

       return $this->query($strQuery);
  }


  function addfeature($name, $tel, $location, $lat,$long, $type){
    $strQuery="Insert into features set name='$name', tel= '$tel' , lat='$lat',lng='$long', Featuretype='$type',Location='$location'";
    return $this->query($strQuery);

  }

  function login_admin($username, $password){
     $strQuery="Select * from admin where username = '$username' and password='$password'";
     return $this->query($strQuery);
  }

  function getreport(){
    $strQuery="Select * from report";
    return $this->query($strQuery);
  }

  function setappointment($name,$institution,$date, $tel,$message){
    $strQuery="Insert into appointment set name='$name', tel= '$tel' , institution='$institution',message='$message', Date='$date'";
    return $this->query($strQuery);
  }

  function getappointment(){
    $strQuery="Select * from appointment";
    return $this->query($strQuery);
  }

}

 ?>
