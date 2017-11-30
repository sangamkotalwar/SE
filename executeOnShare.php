<?php
//include('session.php');
//include('db.php');
global $share, $to;
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
/*
if(isset($_POST['get_data']))
{
        //echo $row2['username'];
    $sql7 = "DELETE FROM " . $row2["username"] . " WHERE title = '".mysqli_real_escape_string($db, $_POST['get_data'])."'";
    $result_1 = mysqli_query($db, $sql7);
    if($result_1)
    header ("location : Directory.php");
    else
        echo mysqli_error($db);
}
*/
if(isset($_GET['data']))
    $share = $_GET['data'];
if(isset($_GET['to']))
    $to = $_GET['to'];
   {
    
     $sql4 = "SELECT * FROM " . $row2["username"] . " WHERE title = '". $share ."'";
             $result_7 = mysqli_query($db, $sql4);
    $row4 = mysqli_fetch_assoc($result_7);
                $entity = $row4['entity'];
                $scope = $row4['scope'];
                $title = $row4['title'];
                $code = $row4['codeSnippet'];
                $description = $row4['description'];
     $result_2 = mysqli_query($db,"INSERT  INTO " . $to . " (entity,  scope,  title, codeSnippet, description) VALUES ('$entity','$scope','$title','$code','$description')");
    if(!$result_2)
            echo mysqli_error($db);
    /*$sql7 = "DELETE FROM " . $row2["username"] . " WHERE id = '". $_GET['del']."'";
    $result_1 = mysqli_query($db, $sql7);*/
    //if($result_1)
    //header ("location : welcome.php");
    //else
      //  echo mysqli_error($db);

   } 
/*
    else
    {
        echo mysqli_error($db);
    }
*/
?> 