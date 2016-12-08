<?php
//check command
if(!isset($_REQUEST['cmd'])){
  echo "cmd is not provided";
  exit();
}
/*get command*/
$cmd=$_REQUEST['cmd'];
switch($cmd){
  case 1:
  signup();		//if cmd=1 the call delete
  break;
  case 2:
  login();
  break;
  default:
  echo "wrong cmd";	//change to json message
  break;
}



function signup(){
  include_once("user.php");
  $obj=new user();
  //check if there is a user code
  if (empty($_REQUEST['fname'])||empty($_REQUEST['lname']) || empty($_REQUEST['username']) || empty($_REQUEST['tel']) ||empty($_REQUEST['password'])){
        echo'{"result":0,"message":"Please provide all sign up details"}';
    return;
  }
  else{

    $username	=$_REQUEST["username"];
    $row=$obj->checkUsername($username);
    $results=$obj->fetch();


    if ($results){
      echo '{"result":0,"message":"Error! Username already exist!"}';
    }

    else{

      $fname= $_REQUEST["fname"];
      $lname=$_REQUEST["lname"];
      $tel=$_REQUEST["tel"];
      $password=$_REQUEST["password"];

      $row=$obj->Signup($fname, $lname,$username,$tel, $password);
      if($row==0){
        echo '{"result":0,"message":"Error! User account cannot be created"}';
        return;
      }
      else{
        $details= $username." successfully created an account";
        $obj->generatereport($details);
        echo '{"result":1,"message":" User account successfully  created"}';
      /*  $sender="POKAZ";
        $message= " You succesfully registered for the Pokaz App. Pokaz! Always here to show your way around!";
        $smsmessage = str_replace(' ','%20', $message);
        $ch = curl_init("http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=$tel&from=$sender&smsc=smsc&text=$smsmessage");
        curl_exec($ch);
        */

        return;

      }
    }
  }
}


function login(){
  include_once("user.php");
  $obj=new user();
  if(!isset($_REQUEST['username'])||!isset($_REQUEST['password'])){
    echo '{"result":0,"message":"Please provide username and password"}';
    return;
  }
  $username	=$_REQUEST["username"];
  $password=MD5($_REQUEST["password"]);
  $row=$obj->login($username,$password);
  $results=$obj->fetch();

  if(!$results){
    $details= $username." tried and failed logging into POKAZ";
    $obj->generatereport($details);
    echo '{"result":0,"message":"Wrong username or password"}';
    return;
  }
  else{
    //session_start();
  //  $_SESSION=$results;
  //  header("location: dashboard.html");
  $details= $username." successfully logged into POKAZ";
  $obj->generatereport($details);
  echo json_encode($results);

  }



}




?>
