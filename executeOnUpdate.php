<?php
include('session.php');
include('db.php');
$id=$loggedin_id;
$_SESSION["mem_id"] = $id;
$uname="SELECT username FROM member WHERE mem_id='$id'";
$yoman=mysqli_query($db,$uname);
$row=mysqli_fetch_assoc($yoman);
$query  =  mysqli_query($db,"SELECT  *  FROM " . $row["username"] . "");
$row2=mysqli_fetch_assoc($query);
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$address=$_POST['address'];
$USERS = "UPDATE member SET fname='" . $_POST['fname'] . "', lname='" . $_POST['lname'] . "', address='" .$_POST['address']. "' WHERE mem_id=" .$_SESSION["mem_id"]. "";
$query=mysqli_query($db,$USERS);
if (!$query) {
	die ('SQL Error: ' . mysqli_error($db));
}
header("location:  welcome.php?remarks=success");
?>