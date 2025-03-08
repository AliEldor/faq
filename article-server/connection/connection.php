<?php
$hostName="localhost";
$dbUser="root";
$dbPassword="";
$dbName = "faq";
$conn=mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);
if(!$conn){
    die("something went wrong") . mysqli_connect_error();
}


?>