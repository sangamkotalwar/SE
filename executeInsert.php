<script  type="text/javascript">
function  countdown()  {
var  i  =  document.getElementById('timecount');
if  (parseInt(i.innerHTML)<=1)  {
location.href  =  'welcome.php';
}
i.innerHTML  =  parseInt(i.innerHTML)-1;
}
setInterval(function(){  countdown();  },1000);
</script>
<?php
include('session.php');
//session_start();
include('db.php');
$id=$loggedin_id;
$_SESSION["mem_id"] = $id;
$uname="SELECT username FROM member WHERE mem_id='$id'"; 
$yoman=mysqli_query($db,$uname);
$row=mysqli_fetch_assoc($yoman);

$result  =  mysqli_query($db,"SELECT  *  FROM " . $row["username"] . "");
$entity = mysqli_real_escape_string($db,$_POST['entity']);
$scope = mysqli_real_escape_string($db,$_POST['scope']);
$title = mysqli_real_escape_string($db,$_POST['title']);
$code = mysqli_real_escape_string($db,$_POST['codeSnippet']);
$description = mysqli_real_escape_string($db,$_POST['description']);
$result = mysqli_query($db,"INSERT  INTO " .$row["username"] . "(entity,  scope,  title, codeSnippet, description) VALUES ('$entity', '$scope','$title','$code','$description')");
if($result){
echo  "<div  align='center'>";
echo  "Code added Successfully. You will be redirected to main page in <div id=\"timecount\">10</div> <u>seconds.</u>";
echo  "<p><a  href='welcome.php'  >Click  here</a>  to  go  back.</p>";
echo  "</div>";
}
elseif(!isset($loggedin_session)  ||  $loggedin_session==NULL)
{
header("Location:  index.php");
}
else  {
echo  "Unable  to  delete  Your  Account";
}
?>