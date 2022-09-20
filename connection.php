<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "crud2";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$con) {
   die(mysqli_connect_error($con));
}
