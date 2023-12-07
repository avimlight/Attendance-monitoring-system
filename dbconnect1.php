<?php
$servername="localhost";
$username="root";
$password="";
$database="staffs";
$conn_staffs=mysqli_connect($servername,$username,$password,$database);
if(!$conn_staffs){
die("sorry we failed to access".mysqli_connect_error());

}






?>