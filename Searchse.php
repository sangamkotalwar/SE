<script type="text/javascript">
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
   <li><form action="" method="GET" name="searchform"><input id="search" name="srchstring" type="text" placeholder="Type here" style="height:30px; width: 300px;" required>
        <select name='dropdown' style="height:35px; text-align-last: center; width : 110px;">
        <option value="general">General</option>
        <option value="task">Task</option>
        <option value="datatype">Data Type</option>
        <option value="class">Class</option>
        <option value="package">Package</option>
        <option value="metod">Method</option>
        <option value="error">Error</option>        
        </select>
        <select name='dropdown2' form="searchform" style="height:35px; text-align-last: center; width : 110px;">
        <option value="private" selected="selected">Private</option>
        <option value="public">Public</option>
        </select>
        <input id="st-btn" name="srchbtn" type="submit" value="Search"/>
        </form></li>
</ul>
</nav>
</header>
<div  id="center">
<div  id="center-set">
<div  id="signup">
<div  id="signup-st" style="overflow-x : auto; background-color : #FFF" >
    <div  align="center"> <?php echo  '<div  id="reg-head"  class="headrg" style="background-color : #000" >Search Result</div>'; ?> </div>
<!--<form  name="reg"  action="execute.php"  onsubmit="return  validateForm()"  method="post"  id="reg"> -->
<table  border="2"  align="center"  cellpadding="3"  cellspacing="2">
    <?php
    global $str;
    
    if(!isset($_GET['srchbtn']))
    echo "&nbsp;&nbsp;&nbsp;please click on the search button to see the results here";
      if(isset($_GET['srchbtn']))  
    {
        $srch = $_GET['srchstring'];
        $dropd = $_GET['dropdown'];  
        $uid = $row2["username"];
        $scope = "private";
        $str=shell_exec("createusertable.exe $uid $srch $dropd $scope");

          $arr = explode(" ", $str);
          $ctr= count($arr) - 1;
           if($ctr<1)
            echo "Oops! No snippets found";

            if($ctr==1)
            echo $ctr." snippet found";

            if($ctr>1)
            echo $ctr." snippets found"; 

          if($ctr>0)
                     { echo '<th>Title</th>';
                          echo '<th style="text-align:center; padding-right : 170px;">Description</th>';     
                      }
        foreach ($arr AS $index => $value)
          {
            
              $qry="SELECT  *  FROM " . $row2["username"] . " WHERE id = '" .$value. "'";
              $result  =  mysqli_query($db, $qry);
            if (mysqli_num_rows($result) > 0) 
            {
                          while($row = mysqli_fetch_assoc($result)) 
                          {
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
                     
          }
          }
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
    ?> </div>
<?php if(isset($_POST['get_data']))
{
    $sql = "SELECT title, codesnippet, description FROM " . $row2["username"] . " WHERE title = '".mysqli_real_escape_string($db, $_POST['get_data'])."'";
    $result_1 = mysqli_query($db, $sql);
    if (mysqli_num_rows($result_1) > 0) 
    {
        $row = mysqli_fetch_assoc($result_1);
    {
        echo "<b>Title</b> : ".$row["title"].'<br><br>';
        echo "<b>Code Snippet</b>: <br>".'<pre>'.htmlspecialchars($row["codesnippet"]).'</pre><br><br>';
        echo "<b>Description</b>: <br>".'<pre>'.$row["description"].'</pre><br><br>';
       
    } 
        $_SESSION["shtitle"] = $row["title"];
      $_SESSION["shdescription"] = $row["description"];  
    }
    
    if(isset($_POST['get_data']))  
    {
        unset($_POST['get_data']); 
        $_POST = array();
    }
}
    
    if(isset($_POST['sharename']))
    {
     
        $sql="SELECT * FROM ".$_POST['sharename']." WHERE title='".$_SESSION['shtitle']."'AND description='".$_SESSION['shdescription']."'";
        $result2 = mysqli_query($db, $sql);
        if($result2)
        {
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
        else echo "Username does not exist";
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