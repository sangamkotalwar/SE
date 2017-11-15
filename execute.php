<?php
session_start();
include('db.php');
$username=$_POST['username'];
 
$result  =  mysqli_query($db,"SELECT  *  FROM  member  WHERE  username='$username'");
$num_rows  =  mysqli_num_rows($result);
 
if  ($num_rows)  {
header("location:  index.php?remarks=failed");
}
else
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$address=$_POST['address'];
$username=$_POST['username'];
$password=$_POST['password'];
$result2 = mysqli_query($db,"CREATE TABLE " . $_POST["username"] . "(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
entity VARCHAR(30) NOT NULL,
scope VARCHAR(30) NOT NULL,
title TEXT NOT NULL,
codeSnippet LONGTEXT NOT NULL,
description LONGTEXT NOT NULL
)");
    
    mysqli_query($db,"INSERT  INTO  member(fname,  lname,  address,username,  password)VALUES('$fname',  '$lname','$address',  '$username',  '$password')");
//$_SESSION["username"] = $username;
  //  echo $username;

    //echo "Table created successfully";
header("location:  index.php?remarks=success");
}
?>