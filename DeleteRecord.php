<?php
include('Directory.php');
$id=$loggedin_id;
$_SESSION["mem_id"] = $id;
$uname="SELECT username FROM member WHERE mem_id='$id'";
$yoman=mysqli_query($db,$uname);
$row2=mysqli_fetch_assoc($yoman);

$result  =  mysqli_query($db,"SELECT  *  FROM " . $row2["username"] . "");

if (!$result)
{
	die ('SQL Error: ' . mysqli_error($db));
}
if($_GET['del'])
   {
     $sql7 = "DELETE FROM " . $row2["username"] . " WHERE id = '". $_GET['del']."'";
    $result_1 = mysqli_query($db, $sql7);
   } 
else
{
    echo mysqli_error($db);
}
?> 