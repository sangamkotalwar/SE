<script  type="text/javascript">
function  countdown()  {
var  i  =  document.getElementById('timecount');
if  (parseInt(i.innerHTML)<=1)  {
location.href  =  'index.php';
}
i.innerHTML  =  parseInt(i.innerHTML)-1;
}
setInterval(function(){  countdown();  },200);
</script>
<?php
include  ('db.php');
include('session.php');
$id=$loggedin_id;
$_SESSION["mem_id"] = $id;
if(count($_POST)>0) 
{
$result = mysqli_query($db,"SELECT * from member WHERE mem_id='" . $_SESSION["mem_id"] . "'");
$row = mysqli_fetch_array($result);
    echo $_SESSION["mem_id"];
    echo $row["password"];
if($_POST["currentPassword"] == $row["password"]) {
mysqli_query($db,"UPDATE member set password='" . $_POST["newPassword"] . "' WHERE mem_id='" . $_SESSION["mem_id"] . "'");
echo  "<div  align='center'>";
echo  "Password changed successfully. You will be redirected to Login page in <div id=\"timecount\">2</div> <u>seconds.</u>";
echo  "<p><a  href='index.php'  >Click  here</a>  to  go  back.</p>";
echo  "</div>";
} else $message = "Current Password is not correct";
}
?>
<html>
<head>
<title>Change Password</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "required";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "required";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "required";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "not same";
	output = false;
}
return output;
}
</script>
</head>
<body>
<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
<div style="width:500px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr class="tableheader">
<td colspan="2">Change Password</td>
</tr>
<tr>
<td width="40%"><label>Current Password</label></td>
<td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
</tr>
<tr>
<td><label>New Password</label></td>
<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
</tr>
<tr>
<td><label>Confirm Password</label></td>
<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body>
</html>