<script type="text/javascript">
function Deleteqry(id)
{ 
  if(confirm("Are you sure you want to delete this row?")==true)
           window.location="DeleteRecord.php?del="+id;
    return false;
}
function shareTo(getData, shareName)
{ 
  console.log(getData);
    if(confirm("Are you sure you want to share this data?")==true)
           window.location="executeOnShare.php?share=".getData." & to=".shareName;
    return false;
}
</script>
<?php
 global $row8,$shareName,$getData,$row11;
include('session.php');
include('db.php');
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
?>
<!DOCTYPE  html>
<html>
<head>
<meta  content='text/html;  charset=UTF-8'  http-equiv='Content-Type'/>
<link  rel="stylesheet"  type="text/css"  href="style.css"  />
<title>Code Utility Software</title>
</head>
<body>
<header>
<nav>
<ul>
   <li style="margin-top:3px"><form action="./welcome.php" method="POST"><input  name="submit"  type="submit"  value="My Profile" id="st-btn"/></form></li>
   <li style="margin-top:3px"><form action="./insert.php"  method="POST"><input  name="submit"  type="submit"  value="Insert"  id="st-btn"/></form></li>
</ul>
</nav>
</header>
<div  id="center">
<div  id="center-set">
<div  id="signup">
<div  id="signup-st" style="overflow-x : auto; background-color : #FFF" >
    <div  align="center"> <?php echo  '<div  id="reg-head"  class="headrg" style="background-color : #000" >Your Directory</div>'; ?> </div>
<!--<form  name="reg"  action="execute.php"  onsubmit="return  validateForm()"  method="post"  id="reg"> -->
<table  border="2"  align="center"  cellpadding="3"  cellspacing="2">
    <?php
        if (mysqli_num_rows($result) > 0) {
       // output data of each row
            echo '<th>Title</th>';
            echo '<th style="text-align:center; padding-right : 170px;">Description</th>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td style="background-color : #3498DB;">';
            echo '<form method="post">';
        /*echo '<td>';
            echo  $row["title"]; echo '</td>';*/
        //echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        //echo  '<input type="submit" name="get_data" value="'.$row["title"].'"></form><br><pre></pre>'. $row["description"]. "<br><br>";
        echo  '<input type="submit" id="st-btn" name="get_data" value="'.$row["title"].'"></form>';
            echo '</td>';
            echo '<td>';
            echo '<pre>'.$row["description"].'</pre>';
            echo '</td>';
            echo '</tr>';
        }
        } else {
    echo "0 results";
        }
    ?>
</table>
<!--<div  id="st"><input  name="submit"  type="submit"  value="Submit"  id="st-btn"/></div>-->
<!-- </form> -->
<!--<div  id="reg-bottom"  class="btmrg">Copyright  &copy;  2017  Team GS</div>-->
</div>
</div>
<?php
    global  $get;
    
if(isset($_POST['get_data']))
    {
        $sql11 = "SELECT * FROM " . $row2["username"] . " WHERE title = '".mysqli_real_escape_string($db, $_POST['get_data'])."'";
             $result_11 = mysqli_query($db, $sql11);
        $row11 = mysqli_fetch_assoc($result_11);
        
        $getData = mysqli_real_escape_string($db, $_POST['get_data']);
        $get = $getData;
        //define($get,$getData);
    /*if(isset($_POST['sharename']))
    {
       $shareName=mysqli_real_escape_string($db,$_POST['sharename']); 
    }*/
    }
    $getData = $get;
    if(isset($_POST['sharename']))
    {
       $shareName=mysqli_real_escape_string($db,$_POST['sharename']); 
    }
?>

<div  id="login">
<div  id="login-st" style="overflow-x : auto; overflow-y : scroll; width: 550px; height: 550px; background-color : #FFF; margin-bottom:0px;">
<div  align="center"> <?php echo  '<div  id="reg-head"  class="headrg" style="background-color : #000" >Overview</div>'; 
echo '<div  id="reg-bottom" style="border-top: 0px solid #A2DED0;">
<nav style="border-top: 0px solid #A2DED0;">
       <li style="width: 331px; padding :0px; background-color:#3498DB"><form action="./executeOnShare.php"  method="POST"><input type="text" name="sharename"/><input name="submit"  type="submit" value="Share" onclick="return shareTO("';echo $getData;echo '","'; echo $shareName; echo '");" id="st-btn"/></form></li>
</nav>
</div>';
 /*   if(isset($_POST['sharename']))
    {
       $shareName=mysqli_real_escape_string($db,$_POST['sharename']); 
    }*/
 /*   if(isset($_POST['get_data']))
    {
        $sql11 = "SELECT * FROM " . $row2["username"] . " WHERE title = '".mysqli_real_escape_string($db, $_POST['get_data'])."'";
             $result_11 = mysqli_query($db, $sql11);
        $row11 = mysqli_fetch_assoc($result_11);
        
        $getData = mysqli_real_escape_string($db, $_POST['get_data']);
    }*/
    
    /*if(isset($_POST['get_data'],$_POST['sharename']))
    {
         //$shareName=mysqli_real_escape_string($db,$_POST['sharename']);
        $sql3="SELECT  mem_id,username  FROM  member  WHERE  username='" . $_POST['sharename'] . "'";
        $result3=mysqli_query($db,$sql3);
        $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
        $count=mysqli_num_rows($result3);
        //echo $row3['username'];
        //if($count == 1)
        {
              $sql4 = "SELECT * FROM " . $row2["username"] . " WHERE title = '".mysqli_real_escape_string($db, $_POST['get_data'])."'";
             $result_7 = mysqli_query($db, $sql4);
            //if (mysqli_num_rows($result_1) > 0) 
            {
                $row4 = mysqli_fetch_assoc($result_7);
                $entity = $row4['entity'];
                $scope = $row4['scope'];
                $title = $row4['title'];
                $code = $row4['codeSnippet'];
                $description = $row4['description'];
                $result_2 = mysqli_query($db,"INSERT  INTO " . $_POST['sharename'] . " (entity,  scope,  title, codeSnippet, description) VALUES ('$entity', '$scope','$title','$code','$description')");
                //if(!result_2)
                //echo mysqli_error($db);
            }
            //else 
            //{
              //  echo "No such user exist";
                //echo mysqli_error($db);                //header("location:  Directory.php?remarks=failed");
            //}
        }
    }*/
    if(isset($_POST['get_data']))
    {
       
        $getData = mysqli_real_escape_string($db, $_POST['get_data']);
        $sql8 = "SELECT * FROM " . $row2["username"] . " WHERE title = '".mysqli_real_escape_string($db, $_POST['get_data'])."'";
         $result_1 = mysqli_query($db, $sql8);
       
        $row8=mysqli_fetch_array($result_1);
    }
    else
    {
        echo mysqli_error($db);
    }
echo '<div id="reg-bottom" style="border-top: 0px solid #A2DED0; margin-right : 50px;">
<nav style="border-top: 0px solid #A2DED0;">
       <li style="width: 200px; background-color:#3498DB; padding : 0;">
       <form action="./DeleteRecord.php"  method="POST"><input  name="submit"  type="submit"  value="Delete" onclick="return Deleteqry(';echo $row8['id']; echo ');" id="st-btn"/></form>
       </li>
</nav>
</div>';
    ?>
</div>
<?php 
    if(isset($_POST['get_data']))
{
    //echo $_POST['get_data'];
    $sql = "SELECT id, title, codesnippet, description FROM " . $row2["username"] . " WHERE title = '".mysqli_real_escape_string($db, $_POST['get_data'])."'";
    $result_1 = mysqli_query($db, $sql);
    if (mysqli_num_rows($result_1) > 0) 
    {
    // output data of each row
    while($row = mysqli_fetch_assoc($result_1)) 
    {
        echo "<b>Title</b> : ".$row["title"].'<br><br>';
        echo "<b>Code Snippet</b>: <br>".'<pre>'.htmlspecialchars($row["codesnippet"]).'</pre><br><br>';
        echo "<b>Description</b>: <br>".'<pre>'.$row["description"].'</pre><br><br>';
       
    }        
    }
    
    if(isset($_POST['get_data']))  
    {
        unset($_POST['get_data']); 
        $_POST = array();
    }
}
?>


      <!-- </form> -->
</div>

</div>
</div>
</div>
<div  id="footer">
 <p>Made with love by Team GSs</p>
 </div>
</body>
</html>