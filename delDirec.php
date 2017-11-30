<!-- directory page -->
   <script type="text/javascript">
    //To delete a query
function Deleteqry(id)
{ 
  if(confirm("Are you sure you want to delete this row?")==true)
           window.location="DeleteRecord.php?del="+id;
    return false;
}
</script>
<?php
global $row8;
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
   <li style="margin-top:3px"><form action="./Searchse.php"  method="POST"><input  name="submit"  type="submit"  value="Search"  id="st-btn"/></form></li>
</ul>
</nav>
</header>
<div  id="center">
<div  id="center-set">
<div  id="signup">
<div  id="signup-st" style="overflow-x : auto; background-color : #FFF" >
    <div  align="center"> <?php echo  '<div  id="reg-head"  class="headrg" style="background-color : #000" >Your Directory</div>'; ?> </div>

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

</div>
</div>
<div  id="login">
<div  id="login-st" style="overflow-x : auto; overflow-y : scroll; width: 550px; height: 550px; background-color : #FFF; margin-bottom:0px;">
<div  align="center"> <?php echo  '<div  id="reg-head"  class="headrg" style="background-color : #000" >Overview</div>'; 
echo '<div  id="reg-bottom" style="border-top: 0px solid #A2DED0;">
<nav style="border-top: 0px solid #A2DED0;">
       <li style="width: 331px; padding :0px; background-color:#3498DB"><form action=""  method="POST"><input type="text" name="sharename" required = "required"/><input  name="sharebtn"  type="submit"  value="Share"  id="st-btn"/></form></li>
</nav>
</div>';

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
    $sql = "SELECT title, codesnippet, description FROM " . $row2["username"] . " WHERE title = '".mysqli_real_escape_string($db, $_POST['get_data'])."'";
    $result_1 = mysqli_query($db, $sql);
    if (mysqli_num_rows($result_1) > 0) 
    {
    // output data of each row
    //while($row = mysqli_fetch_assoc($result_1)) 
    {
        $row = mysqli_fetch_assoc($result_1);
        echo "<b>Title</b> : ".$row["title"].'<br><br>';
        echo "<b>Code Snippet</b>: <br>".'<pre>'.htmlspecialchars($row["codesnippet"]).'</pre><br><br>';
        echo "<b>Description</b>: <br>".'<pre>'.$row["description"].'</pre><br><br>';
       
    }  
        //Share utility
      $_SESSION["shtitle"] = $row["title"];
      $_SESSION["shdescription"] = $row["description"];     
    }
    
    if(isset($_POST['get_data']))  
    {
        unset($_POST['get_data']); 
        $_POST = array();
    }
}
    //Share utility
    if(isset($_POST['sharename']))
    {
     
        $sql="SELECT * FROM ".$_POST['sharename']." WHERE title='".$_SESSION['shtitle']."'AND description='".$_SESSION['shdescription']."'";
        $result2 = mysqli_query($db, $sql);
        if($result2)
        {
            $counter = mysqli_num_rows($result2);
        
        if (mysqli_num_rows($result2)>0)
        {
            echo "This data is already present";
        }
        else
        {
            $sql11="SELECT * FROM ".$row2["username"]."  WHERE title='".$_SESSION['shtitle']."' AND description= '".$_SESSION['shdescription']."'";
           
            $result3= mysqli_query($db, $sql11);
            $row11 = mysqli_fetch_assoc($result3);
          
            $sql1='INSERT INTO '.$_POST["sharename"].' ( entity, scope, title, codeSnippet, description) VALUES ("'.mysqli_real_escape_string($db, $row11["entity"]).'", "'.mysqli_real_escape_string($db, $row11["scope"]).'", "'.mysqli_real_escape_string($db, $row11["title"]).'", "'.mysqli_real_escape_string($db, $row11["codeSnippet"]).'", "'.mysqli_real_escape_string($db, $row11["description"]).'")'; 
                     
            if($res = mysqli_query($db, $sql1))
            {
                echo "Data Inserted";
              
            }
            else
            {
                echo("Error description: " . mysqli_error($db));
            }
            
        }
        }
     else echo "Username doest not exist";
   
    }
?>
</div>
</div>
</div>
</div>
<div  id="footer">
 <p>Made with love by Team GSs</p>
 </div>
</body>
</html>