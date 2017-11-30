<?php
include('session.php');
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
   <li><form action="./insert.php"  method="POST"><input  name="submit"  type="submit"  value="Insert"  id="st-btn"/></form></li>
   <li><form action="./Searchse.php"  method="POST"><input  name="submit"  type="submit"  value="Search"  id="st-btn"/></form></li>
</ul>
</nav>
</header>
<div  id="center">
<div  id="center-set">
<p  align='center'  style="font-weight:bold;  font-size:20px;  font-family:Segoe  Print;  color:#3498DB;"></p>
<h1  align='center'>Welcome  <?php  echo  $loggedin_session;  ?>,</h1>
<p  align='center'>  You  are  now  logged  in to Code Utility Software.  you  can  logout  by  clicking  on  signout  link  given  below.</p>
<div  id="contentbox">
<?php
include('db.php');
$sql="SELECT  *  FROM  member  where  mem_id=$loggedin_id";
$result=mysqli_query($db,$sql);
?>
<?php
while($rows=mysqli_fetch_array($result)){
?>
<div  id="signup">
<div  id="signup-st">
<form  action=""  method="POST"  id="signin"  id="reg">
<div  id="reg-head"  class="headrg">Your  Profile</div>
<table  border="0"  align="center"  cellpadding="2"  cellspacing="0">
<tr  id="lg-1">
<td  class="tl-1"><div  align="left"  id="tb-name">Reg  id:</div></td>
<td  class="tl-4"><?php  echo  $rows['mem_id'];  ?></td>
</tr>
<tr  id="lg-1">
<td  class="tl-1"><div  align="left"  id="tb-name">Name:</div></td>
<td  class="tl-4"><?php  echo  $rows['fname'];  ?>  <?php  echo  $rows['lname'];  ?></td>
</tr>
<tr  id="lg-1">
<td  class="tl-1"><div  align="left"  id="tb-name">Email  id:</div></td>
<td  class="tl-4"><?php  echo  $rows['address'];  ?></td>
</tr>
</table>
<div  id="reg-bottom"  class="btmrg">Copyright  &copy;  2017 Team GS</div>
</form>
</div>
</div>
<div  id="login">
<div  id="login-sg">
<div  id="st"><a  href="delDirec.php" id="st-btn">Directory</a></div>
<div  id="st"><a  href="displaying_data.php" id="st-btn">Personal Database</a></div>
<div  id="st"><a  href="update.php" id="st-btn">Update Profile</a></div>
<div  id="st"><a  href="logout.php"  id="st-btn">Sign  Out</a></div>
<div  id="st"><a  href="deleteac.php"  id="st-btn">Delete  Account</a></div>
<div  id="st"><a  href="change_password.php"  id="st-btn">Change Password</a></div>
</div>
</div>
<?php
}
?>
</div>
</div>
</div>
<?php
mysqli_close($db);
?>
<br/>
<div  id="footer">
<p>Copyright  &copy;  2017 Team GS</p>
</div>
</body>
</html>