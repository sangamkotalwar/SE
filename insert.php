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

     <li><form action="./welcome.php"  method="POST"><input  name="submit"  type="submit"  value="My Profile"  id="st-btn"/> </form></li>

    <li><form action="./Searchse.php"  method="POST"><input  name="submit"  type="submit"  value="Search"  id="st-btn"/></form></li>
</ul>
</nav>
</header>
<div  id="center">
<div  id="center-set">
<p  align='center'  style="font-weight:bold;  font-size:20px;  font-family:Segoe  Print;  color:#3498DB;"> Code Utility Software. Insert your code here.</p>

<div  id="signup">
<div  id="signup-st">
 <div  align="center">
<?php
     $remarks  =  isset($_GET['remarks'])  ?  $_GET['remarks']  :  '';
     if  ($remarks==null  and  $remarks=="")
{
   echo  '<div  id="reg-head"  class="headrg">Insert in table here</div>';
       }
     if  ($remarks=='success')
{
   echo  '<div  id="reg-head"  class="headrg">Successfully Inserted</div>';
       }
     if  ($remarks=='failed')
{
   echo  '<div  id="reg-head-fail"  class="headrg">Insertion Failed. Same Title already exists.</div>';
       }
?>
       </div>
<form  name="reg"  action="./executeInsert.php"  onsubmit="return  validateForm()"  method="post"  id="reg">
<!--<form>-->
<table  border="0"  align="center"  cellpadding="2"  cellspacing="0">

   <tr>
       <td  class="t-1">
       <div  align="left"  id="tb-name">Entity: </div>
<!--      <label for="entityX">Entity</label>-->
       </td>
       <td  width="171" style="color:#fff;">
         <select form="reg" name="entity" style=" text-align-last: center; height: 25px; width : 205px;" id="entityX" >
          <option value="task" selected="selected" class="task">Task</option>
          <option value="datatype">Data Type</option>
          <option value="class">Class</option>
          <option value="package">Package</option>
          <option value="metod">Method</option>
          <option value="error">Error</option>
         </select>
       </td>
   </tr>
   <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Scope: </div>
       </td>
       <td  width="171" style="color:#fff;">
         <select form="reg" name="scope" style="height: 25px; width : 205px; text-align-last : center;">
           <!-- <option value="select"> Select </option>  -->
          <option value="public">Public</option>
          <option value="private" selected="selected">Private</option>
         </select>
       </td>
   </tr>
     <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Title: </div></td>
       <td><input  type="text"  id="tb-box"  name="title" required /></td>
   </tr>
 <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Code: </div></td>
       <td><textarea name="codeSnippet" cols="35" rows="10" required></textarea></td>
   </tr>
 <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Description: </div></td>
       <td><textarea name="description" cols="35" rows="10" required></textarea></td>
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