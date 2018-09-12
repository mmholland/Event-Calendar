<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create Event</title>
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
	img.clogo {
		display: block;
		margin: auto;
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
	a {
		text-decoration: none;
	}
	p.subtitle {
		color: #2164d1;
		font-family: Arial, sans-serif;
		text-align: left;
		margin-left: 25%
	}
	.button {
		background-color: #2164d1;
		color: white;
		padding: 10px 80px;
		text-align: center;
		margin: 10px;
		font-size: 16px;
		border-radius: none;
		border: none;
	}
	.input {
		width: 80%;
		padding: 6px 0px;
	}	
	div.body {
		margin: 10px;
		text-align: center;
		align: center;
	}
	table {
		table-layout: fixed;
		width: 100%;
	}
	td {
		text-align: left;
	}
	</style>
</head>
<body>
<div id="container">
	<div class="navbar">
		<ul class="navbar">
			<li><a href="/~mmh32/CO600/Project/index.php/home">Home</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/search">Search</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/calendar/">Events</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/logout/">Logout</a></li>
		</ul>
		<br>
	</div>
	<img class="clogo" src="/~mmh32/CO600/Project/images/SoC_logo.jpg">
	<div class="body">
	<p class="intro">Enter details of the event below.</p>
		<form id="create_event" action="/~mmh32/CO600/Project/index.php/admin/create_event/" method="post" enctype="multipart/form-data">
			<table>
				<tr><td><p class="subtitle">Title:</p></td><td><input class="input" type="text" name="title" id="title" required /></td></tr>
				<tr><td><p class="subtitle">Location:</p></td><td><input class="input" type="text" name="location" id="location" maxlength="20" required /></td></tr>
				<tr><td><p class="subtitle">Host:</p></td><td><input class="input" type="text" name="host" id="host" maxlength="20" required /></td></tr>
				<tr><td><p class="subtitle">Description:</p></td><td><input class="input" type="text" name="desc" id="desc" maxlength="256" required /></td></tr>
				<tr><td><p class="subtitle">Day:</p></td><td>
				<select class="input" name="day" id="day">
					<?php
					$i = 1;
					while ($i <= 31)
					{
						if ($i <= 9)
						{
							$i = sprintf("%02d", $i);
							echo "<option value='".$i."'>".$i."</option>";
							$i++;
						}
						else
						{
							echo "<option value='".$i."'>".$i."</option>";
							$i++;
						}
					}
					?>
				</select></td></tr>	
				<tr><td><p class="subtitle">Month:</p>
				</td><td><select class="input" name="month" id="month">
					<?php
					$i = 1;
					while ($i <= 12)
					{
						if ($i <= 9)
						{
							$i = sprintf("%02d", $i);
							echo "<option value='".$i."'>".$i."</option>";
							$i++;
						}
						else
						{
							echo "<option value='".$i."'>".$i."</option>";
							$i++;
						}
					}
					?>
				</select></td></tr>
			<tr><td><p class="subtitle">Time:</p></td><td><input class="input" type="text" name="starttime" id="starttime" maxlength="8" required /></td></tr>
			<tr><td><p class="subtitle">Image:</p></td><td><input class="input" type="file" name="image" required /></td></tr>
			</table>
			<br><br>
			<input class="button" type="submit" name="Submit" value="Create Event" />
		</form>
	</div>
	<p class="footer">CO600 Project</p>
</div>
<img class="klogo" src="/~mmh32/CO600/Project/images/UoK_logo.png" align="right">
</body>
</html>