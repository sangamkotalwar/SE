<?php
include('session.php');
//session_start();
include('db.php');
$id=$loggedin_id;
$_SESSION["mem_id"] = $id;
$uname="SELECT * FROM member WHERE mem_id='$id'"; 
$yoman=mysqli_query($db,$uname);
$row=mysqli_fetch_assoc($yoman);
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
     <form action="./welcome.php"  method="POST">
     <li><input  name="submit"  type="submit"  value="My Profile"  id="st-btn"/></li>
     <li><form action="./Searchse.php"  method="POST"><input  name="submit"  type="submit"  value="Search"  id="st-btn"/></form></li>
    </form>
</ul>
</nav>
</header>
<div  id="center">
<div  id="center-set">
<p  align='center'  style="font-weight:bold;  font-size:20px;  font-family:Segoe  Print;  color:#3498DB;"> Code Utility Software. Update your profile here!</p>
<div  id="signup">
<div  id="signup-st">
 <div  align="center">
<?php
     $remarks  =  isset($_GET['remarks'])  ?  $_GET['remarks']  :  '';
     if  ($remarks==null  and  $remarks=="")
{
   echo  '<div  id="reg-head"  class="headrg">Update in table here</div>';
       }
     if  ($remarks=='success')
{
   echo  '<div  id="reg-head"  class="headrg">Successfully Updates</div>';
       }
     if  ($remarks=='failed')
{
   echo  '<div  id="reg-head-fail"  class="headrg">Updation Failed.</div>';
       }
?>
       </div>
<form  name="reg"  action="./executeOnUpdate.php"  onsubmit="return  validateForm()"  method="post"  id="reg">
<table  border="0"  align="center"  cellpadding="2"  cellspacing="0">
<tr>
       <td  class="t-1"><div  align="left"  id="tb-name">First&nbsp;Name:</div></td>
       <td  width="171"><input  type="text" name="fname" id="tb-box" value="<?php echo $row['fname'];?>"/></td>
   </tr>
   <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Last&nbsp;Name:</div></td>
       <td><input type="text" name="lname" id="tb-box" value="<?php echo $row['lname']; ?>"/></td>
   </tr>
     <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Email:</div></td>
       <td><input  type="text"  id="tb-box"  name="address" value="<?php echo $row['address']; ?>" /></td>
   </tr>
 <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Username:</div></td>
       <td><!--<input  type="text"  id="tb-box"  name="username" placeholder="Username" />-->
       <label for="t-1" style="position:relative; color:#FFF;"><?php echo $row['username']; ?></label></td>
   </tr>
</table>
       <div  id="st"><input  name="submit"  type="submit"  value="Submit"  id="st-btn"/></div>
</form>
<div  id="reg-bottom"  class="btmrg">Copyright  &copy;  2017  Team GS</div>
</div>
</div>
    </div>
    </div>
    </body>
</html>