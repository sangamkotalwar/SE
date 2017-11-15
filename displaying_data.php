<?php

include('session.php');
//session_start();
include('db.php');
$id=$loggedin_id;
$_SESSION["mem_id"] = $id;
$uname="SELECT username FROM member WHERE mem_id='$id'";
$yoman=mysqli_query($db,$uname);
$row=mysqli_fetch_assoc($yoman);

$query  =  mysqli_query($db,"SELECT  *  FROM " . $row["username"] . "");

if (!$query) {
	die ('SQL Error: ' . mysqli_error($db));
}
?>
<html>
<head>
	<title>Displaying MySQL Data in HTML Table</title>
	<style type="text/css">
        
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 20px 175px 0 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			transition: all .5s;
		}

		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th,
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
            pre {
 white-space: pre-wrap;       /* css-3 */
 white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
 white-space: -pre-wrap;      /* Opera 4-6 */
 white-space: -o-pre-wrap;    /* Opera 7 */
 word-wrap: break-word;       /* Internet Explorer 5.5+ */
}
        header{background-color:#fff;  width:100%;  height:55px;  margin:0px;}
nav{width:100%;  border-top:5px  solid  #3498DB;}
nav  ul{float:left;  border-left:6px  solid  #BDC3C7;    height:50px;  }
nav  li{list-style:none;  font-size:30px;  font-weight:bold;  padding-right:10px;  padding-left:10px;  border-right:1px  solid  #BDC3C7;  width:auto;  font-family:Gabriola;
color:#3498DB;  float:left;  height:50px;}
nav  li:hover{color:#fff;background-color:#3498DB;  transition:1s;}
        #st-btn{  text-align:center;  padding:10px  21px  10px  21px;  background-color:#3498DB;  border:none;color:#fff;  cursor:pointer;  font-size:20px;  font-weight:bold;}
#st-btn:hover{color:#3498DB;  background:#fff;transition:1s;}
	</style>
</head>

<body>
<header>
<nav>
<ul>
     <form action="./welcome.php"  method="POST">
     <li><input  name="submit"  type="submit"  value="My Profile"  id="st-btn"/></li>
    </form>
</ul>
</nav>
</header>
<h1 style="text-align:center;">Personal Database</h1>
	<table class="data-table">
		<caption class="title" style="text-align:center;">Table</caption>
		<thead>
			<tr>
				<th>Sr. No.</th>
				<th>Entity</th>
				<th>Scope</th>
				<th>Title</th>
				<th>Code Snippet</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no 	= 1;
		$total 	= 0;
		while ($row = mysqli_fetch_array($query))
		{
			//$amount  = $row['amount'] == 0 ? '' : number_format($row['amount']);
			echo '<tr>
					<td>'.$no.'</td>
					<td>'.$row['entity'].'</td>
					<td>'.$row['scope'].'</td>
					<td>'.$row['title'].'</td>';
					echo '<td><pre>'.nl2br($row['codeSnippet']).'</pre></td>';
					echo '<td><pre>'.nl2br($row['description']).'</pre></td>
				</tr>';
			$total = $no;
			$no++;
		}?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="4">Total Entries</th>
				<th><?=number_format($total)?></th>
			</tr>
		</tfoot>
	</table>
</body>
</html>