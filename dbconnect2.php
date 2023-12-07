<?php
$servername="localhost";
$username="root";
$password="";
$database="attendance";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
die("sorry we failed to access".mysqli_connect_error());

}






?>