<?php
include_once("setting.php");

$mysqli=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
if($mysqli->connect_errno){
  //no connection, exit
  echo "Error with connection";
  exit();
}

$results=$mysqli -> query("Select * from features");

if($results==false){
  echo "$mysqli->error";
  exit();
}


while($row=$results-> fetch_assoc())
{
  $rows[]=$row;


}
echo json_encode($rows);


?>
