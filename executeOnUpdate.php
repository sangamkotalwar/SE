<?php
include('session.php');
//session_start();
include('db.php');
$id=$loggedin_id;
$_SESSION["mem_id"] = $id;
$uname="SELECT username FROM member WHERE mem_id='$id'";
$yoman=mysqli_query($db,$uname);
$row=mysqli_fetch_assoc($yoman);
//echo $row['username'];
$query  =  mysqli_query($db,"SELECT  *  FROM " . $row["username"] . "");
$row2=mysqli_fetch_assoc($query);
//echo $row2['username'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$address=$_POST['address'];
//echo $row2['username'];
//$username=$row2['username'];
//$password=$row2['password'];
    //mysqli_query($db,"INSERT  INTO  member(fname,  lname,  address,username,  password)VALUES('$fname',  '$lname','$address',  '$username',  '$password')");
//$_SESSION["username"] = $username;
    echo $fname;
$USERS = "UPDATE member SET fname='" . $_POST['fname'] . "', lname='" . $_POST['lname'] . "', address='" .$_POST['address']. "' WHERE mem_id=" .$_SESSION["mem_id"]. "";
$query=mysqli_query($db,$USERS);
if (!$query) {
	die ('SQL Error: ' . mysqli_error($db));
}

    //echo "Table created successfully";
header("location:  welcome.php?remarks=success");

?>