<?php
include('session.php');
include('db.php');
$id=$loggedin_id;
$_SESSION["mem_id"] = $id;
$uname="SELECT username FROM member WHERE mem_id='$id'";
$yoman=mysqli_query($db,$uname);
$row2=mysqli_fetch_assoc($yoman);

$result  =  mysqli_query($db,"SELECT  *  FROM " . $row2["username"]);

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
   <li><form action="./welcome.php"  method="POST"><input  name="submit"  type="submit"  value="My Profile"  id="st-btn"/></form></li>
   <li><form action="./insert.php"  method="POST"><input  name="submit"  type="submit"  value="Insert"  id="st-btn"/></form></li>
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

<div  id="login">
<div  id="login-st" style="overflow-x : auto; overflow-y : scroll; width: 550px; height: 550px; background-color : #FFF; margin-bottom:0px;">
<div  align="center"> <?php echo  '<div  id="reg-head"  class="headrg" style="background-color : #000" >Overview</div>'; 
echo '<div  id="reg-bottom" style="border-top: 0px solid #A2DED0;">
<nav style="border-top: 0px solid #A2DED0;">
       <li style="width: 331px; padding :0px; background-color:#3498DB"><form action=""  method="POST"><input type="text" name="sharename" required = "required"/><input  name="sharebtn"  type="submit"  value="Share"  id="st-btn"/></form></li>
</nav>
</div>
<div id="reg-bottom" style="border-top: 0px solid #A2DED0; margin-right : 50px;">
<nav style="border-top: 0px solid #A2DED0;">
       <li style="width: 200px; background-color:#3498DB; padding : 0;">
       <form action="./insert.php"  method="POST"><input  name="submit"  type="submit"  value="Delete"  id="st-btn"/></form>
       </li>
</nav>
</div>';    
    ?> </div>
<?php 
if(isset($_POST['get_data']))
{
    //echo $_POST['get_data'];
    $sql = "SELECT title, codesnippet, description FROM " . $row2["username"] . " WHERE title = '".mysqli_real_escape_string($db, $_POST['get_data'])."'";
    $result_1 = mysqli_query($db, $sql);
    if (mysqli_num_rows($result_1) > 0) 
    {
    // output data of each row
    $row = mysqli_fetch_assoc($result_1); 
    
        echo "<b>Title</b> : ".$row["title"].'<br><br>';
        echo "<b>Code Snippet</b>: <br>".'<pre>'.htmlspecialchars($row["codesnippet"]).'</pre><br><br>';
        echo "<b>Description</b>: <br>".'<pre>'.$row["description"].'</pre><br><br>';
       
      $_SESSION["shtitle"] = $row["title"];
      $_SESSION["shdescription"] = $row["description"];    
    }
    
}


if(isset($_POST['sharename']))
    {
      // echo $_SESSION["shtitle"];
      // echo $_SESSION["shdescription"];
      // echo $row2["username"];
        $sql="SELECT * FROM ".$_POST['sharename']." WHERE title='".$_SESSION['shtitle']."'AND description='".$_SESSION['shdescription']."'";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result)>0)
        {
            echo "This data is already present";
        }
        else
        {
            $sql="SELECT * FROM ".$row2["username"]."  WHERE title='".$_SESSION['shtitle']."' AND description= '".$_SESSION['shdescription']."'";
             // $sql="SELECT * FROM ".$row2["username"];
            $result= mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);
            //echo $_POST['share'];
            //echo $_SESSION['title'];
            //$sql="SELECT * FROM ".$_POST['share']." WHERE Title= '".$_SESSION['title']."'";
            $sql1='INSERT INTO '.$_POST["sharename"].' ( entity, scope, title, codeSnippet, description) VALUES ("'.$row["title"].'", "'.mysqli_real_escape_string($db, $row["codeSnippet"]).'", "'.mysqli_real_escape_string($db, $row["description"]).'", "'.$row["entity"].'", "'.$row["scope"].'")'; 
                        //SELECT Title, Code, Description, Entity_type, Access FROM ganesh WHERE Title='".$_SESSION['title']."'";
                    //AND Description='".$_SESSION['desc']."'";
            
            
            //VALUES ("'.$row["Title"].'", "'.$row["Code"].'", "'.$row["Description"].'", "'.$row["Entity_type"].'", "'.$row["Access"].'")';
            //$result_1 = mysqli_query($conn, $sql1);
            //echo mysqli_num_rows($result_1);
            if(mysqli_query($db, $sql1))
            {
                echo "Data Inserted";
                /*if (mysqli_num_rows($result_1) > 0)
                {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result_1)) 
                    {
                        echo $row["Title"].'<br>';
                        //echo '<pre>'.$row["Code"].'</pre><br>';
                        echo $row["Description"].'<br>';
                        //$_SESSION['data']=$row["Title"];

                    }
                }*/
            }
            else
            {
                echo("Error description: " . mysqli_error($db));
            }
            
        }
        /*$result_1 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result_1) > 0)
        {
            // output data of each row
            while($row = mysqli_fetch_assoc($result_1)) 
            {
                echo $row["Title"].'<br>';
                //echo '<pre>'.$row["Code"].'</pre><br>';
                echo $row["Description"].'<br>';
                //$_SESSION['data']=$row["Title"];

            }//insert into xyz(t_id,v_id,f_name) select t_id,v_id,f_name from xyz2
        }*/
        //echo $_SESSION['title'];
        //echo 123;
    }






?>


      <!-- </form> -->
</div>
<!--
<div  id="reg-bottom" style="border-top: 5px solid #A2DED0;">
<nav style="border-top: 5px solid #A2DED0;">
       <li style="width: 300px; padding :0px; background-color:#3498DB"><form action="./welcome.php"  method="POST"><input type="text" name="sharename"/><input  name="submit"  type="submit"  value="Share"  id="st-btn"/></form></li>
</nav>
</div>
<div id="reg-bottom" style="border-top: 5px solid #A2DED0;">
<nav style="border-top: 0px solid #A2DED0;">
       <li style="width: 200px; background-color:#3498DB; padding : 0;">
       <form action="./insert.php"  method="POST"><input  name="submit"  type="submit"  value="Delete"  id="st-btn"/></form>
       </li>
</nav>
</div>
-->
</div>
</div>
</div>
<div  id="footer">
 <p>Made with love by Team GSs</p>
 </div>
</body>
</html>