<!-- // Checks the database connectiond etials are ok  -->
<?php
$host="localhost";
$db_name="mvc";
$user = "root";
$password = "";

// <!-- /*Creating connection*/ -->
$conn = new mysqli($host,$user,$password,$db_name);

// <!-- check the connection -->
if($conn->connect_error){
  echo "Connection failed:". $conn->connect_error;
}
else{
echo "Database sucessfully connected,all connection are ok";
}
?>
