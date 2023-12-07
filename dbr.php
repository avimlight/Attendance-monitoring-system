<?php
require 'dbconnect.php';

$sql="SELECT *FROM `students`";
$result=mysqli_query($conn,$sql);

$num=mysqli_num_rows($result);
echo "the number of rows are ".$num;


?>