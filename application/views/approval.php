<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin Panel: Pending Approvals</title>

	<style type="text/css">
	#container {
		margin: 10px;
		border: 1px solid #2164d1;
		box-shadow: 0 0 8px #2164d1;
	}
	div.navbar {
		margin: 10px;
		border: 1px solid #2164d1;
		text-align: center;
	}
	ul.navbar {
		list-style: none;
		width: 100%;
		height: 100%;
		padding: 0;
		margin: 0;
	}
	ul.navbar li {
		float: left;
		height: 100%;
		width: 25%;
	}
	body {
		background-color: #fff;
		margin: 40px;
		font: 20px/30px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}
	#body {
		margin: 0 15px 0 15px;
	}
	p.footer {
		text-align: center;
		border-top: 1px solid #2164d1;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	p.title {
		text-align: center;
		font-size: 40px;
	}
	ul.desc {
		margin-left: 50px;
		list-style: none;
		font-size: 24px;
	}
	p.info {
		text-align: right;
		margin-right: 160px;
		font-size: 16px;
	}
	a {
		text-decoration: none;
	}
	p.subtitle {
		color: #2164d1;
		font-family: Arial, sans-serif;
	}
	.button {
		background-color: #2164d1;
		color: white;
		padding: 10px 20px;
		text-align: center;
		margin: 10px;
		font-size: 16px;
		border-radius: none;
		border: none;
	}
	div.admin {
		margin: 10px;
	}
	table {
		table-layout: fixed;
		width: 100%;
		margin-left: auto;
		margin-right: auto;
	}
	img.clogo {
		display: block;
		margin: auto;
		width: 150px;
		height: 100px;
	}
	table.banner {
		table-layout: fixed;
		width: 100%;
	}
	th.banner {
		border-right: 1px solid #005DA7;
	}
	th:last-child.banner {
		border-right: none;
	}
	div.banner {
		text-align: center;
		line-height: 0.4;
	}
	p.banner {
		font-size: 46px;
		color: #2164d1;
	}
	td {
		width: 25%;
		align: center;
	}
	</style>
</head>
<body>
	<div class="banner">
		<table class="banner">
		<th class="banner"><img class="clogo" src="/~mmh32/CO600/Project/images/SoC_logo.jpg"></th>
		<th class="banner"><p class="banner">Approval</p></th>
		<th class="banner"><p class="banner">Page</p></th>
		</table>
		<br>
	</div>
<div id="container">
	<div class="navbar">
		<ul class="navbar">
			<li><a href="/~mmh32/CO600/Project/index.php/home">Home</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/search">Search</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/calendar/">Events</a></li>
			<li><a href='/~mmh32/CO600/Project/index.php/home/logout'>Logout</a></li>
		</ul>
		<br>
	</div><br>
	<div class="admin"><p class="title">Pending Approvals</p><br>
		<table>
		<th>First Name</th><th>Last Name</th><th>School</th><th>Event</th><th>Availability</th><th>Approve?</th>
		<?php
			foreach ($pendingApprovals->result() as $row):
				echo "<tr><td align='center'><p>".ucfirst($row->firstname)."</p></td>";
				echo "<td align='center'><p>".$row->lastname."</p></td>";
				echo "<td align='center'><p>".$row->typeOfStudy."</p></td>";
				echo "<td align='center'><p>".$row->title."</p></td>";
				echo "<td align='center'><p>".$row->available."/".$row->quantity."</p></td>";
				echo "<td align='center'><form id='adminpanel' action='/~mmh32/CO600/Project/index.php/admin/approvestudent/".$row->attendanceID."/'><input class='button' type='submit' name='Submit' value='Approve' method='post'/></form></td></tr>";
			endforeach;
		?>
		</table>
		<br>
	</div>
	<br>
	<p class="footer">CO600 Project</p>
<img class="klogo" src="/~mmh32/CO600/Project/images/UoK_logo.png" align="right">
</div>
</body>
</html>