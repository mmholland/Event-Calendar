<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin Panel</title>

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
		padding: 10px 80px;
		text-align: center;
		margin: 10px;
		font-size: 32px;
		border-radius: none;
		border: none;
		width: 100%;
		height: 100px;
	}
	div.admin {
		margin: 10px;
	}
	table {
		table-layout: fixed;
		width: 80%;
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
	</style>
</head>
<body>
	<div class="banner">
		<table class="banner">
		<th class="banner"><img class="clogo" src="/~mmh32/CO600/Project/images/SoC_logo.jpg"></th>
		<th class="banner"><p class="banner">Admin</p></th>
		<th class="banner"><p class="banner">Panel</p></th>
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
	</div>
	<div class="admin"><br><br>
	<table>
	<tr><td><form id='adminpanel' action='/~mmh32/CO600/Project/index.php/admin/addevent/' method='POST'><input class='button' type='submit' name='Submit' value='Add Event' /></form></td><td><form id='adminpanel' action='/~mmh32/CO600/Project/index.php/admin/purgeevents/' method='POST'><input class='button' type='submit' name='Submit' value='Purge Events' /></form></td></tr>
	<tr><td><form id='adminpanel' action='/~mmh32/CO600/Project/index.php/admin/approval/' method='POST'><input class='button' type='submit' name='Submit' value='Approve Events' /></form></td><td><form id='adminpanel' action='/~mmh32/CO600/Project/index.php/admin/#/' method='POST'><input class='button' type='submit' name='Submit' value='#' /></form></td></tr>
	</table>
	</div>
	<br>
	<p class="footer">CO600 Project</p>
<img class="klogo" src="/~mmh32/CO600/Project/images/UoK_logo.png" align="right">
</div>
</body>
</html>