<?php

$con = mysqli_connect('localhost','root','','mystore');
if(!$con){
    throw new Exception('Connection failed: ' . mysqli_connect_error());
   // die(mysqli_error($con));
}
?>