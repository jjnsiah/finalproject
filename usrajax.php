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
  case 3:
  sms();
  break;
  case 4:
  addappointment();
  break;
  default:
  echo "wrong cmd";	//change to json message
  break;
}

function addappointment(){
  include_once("user.php");
  $obj=new user();
  //$name="+user+"&institution="+institution+"&message="+message+"&tel="+tel+"&date="+date;
  //check if there is a user code
  if (empty($_REQUEST['name'])||empty($_REQUEST['institution']) || empty($_REQUEST['message']) || empty($_REQUEST['tel']) ||empty($_REQUEST['date'])){
        echo'{"result":0,"message":"Please provide all appointment details"}';
    return;
  }
  else{

      $name	=$_REQUEST["name"];
      $insti= $_REQUEST["institution"];
      $msg=$_REQUEST["message"];
      $tel=$_REQUEST["tel"];
      $date=$_REQUEST["date"];

      $row=$obj->setappointment($name,$insti,$date, $tel,$msg);
      if($row==0){
        echo '{"result":0,"message":"Error! Appointment creation error"}';
        return;
      }
      else{
        $details= $name." set an appointment";
        $obj->generatereport($details);
        echo '{"result":1,"message":" Appointment successfully  created"}';
        return;

      }
    }
  }


function sms(){
  //$username	=$_REQUEST["username"];
  $tel=$_REQUEST["number"];
  echo '{"result":1,"message":" You joined pokaz "}';
    $sender="POKAZ";

    $message="You succesfully joined pokaz";
    $smsmessage = str_replace(' ','%20', $message);
    $ch = curl_init("http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=$tel&from=$sender&smsc=smsc&text=$smsmessage");
    curl_exec($ch);
  /*$ch = curl_init();
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);
  $response=curl_exec($ch);
  curl_close($ch);
  */




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
