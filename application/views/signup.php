<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Signup</title>
	<!-- load jQuery from Google CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	// causes error message from PHP function to fade out (from server side validation)
	$(document).ready(function() {
		$(".errormsg").fadeOut(4500);
	});
	// basic email validation. checks to see if input contains both a '@' and a '.'
		function validateForm() 
		{
			// retrieve email input.
			var email = document.forms["register"]["email"].value;
			// check if email string contains "@" and "."
			if (email.includes("@") && email.includes("."))
			{
				return true;
			}
			// if false, displays error message which fades out after 4.5 seconds.
			else
			{
				document.getElementById("errormsg").style.display = 'block';
				$(".errormsg").fadeOut(4500);
				return false;
			}
		}
	</script>
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
		width: 33%;
	}
	img.clogo {
		display: block;
		margin: auto;
		width: 150px;
		height: 100px;
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
		margin-left: 35%;
	}
	p.intro {
		color: #2164d1;
		font-family: Arial, sans-serif;
		text-align: centre;
	}
	p.errormsg {
		color: red;
		font-family: Arial, sans-serif;
		text-align: centre;
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
		width: 75%;
		padding: 10px 0px;
	}	
	div.signup {
		margin: 10px;
		text-align: center;
		align: center;
	}
	table {
		table-layout: fixed;
		width: 100%;
	}
	th {
		border-right: 1px solid #005DA7;
	}
	th:last-child {
		border-right: none;
	}
	td {
		text-align: center;
	}
	td.input {
		width: 75%;
	}
	a {
		text-decoration: none;
	}
	div.banner {
		text-align: center;
		line-height: 0.4;
	}
	div p.loc {
		font-style: italic;
	}
	</style>
</head>
<body>
	<!-- div and table containing the banner -->
	<div class="banner">
		<table>
		<!-- School of Computing logo -->
		<th><img class="clogo" src="/~mmh32/CO600/Project/images/SoC_logo.jpg"></th>
		<?php
			// for each loop that loads the two event previews and displays them in the banner, wrapping HTML around the data.
			foreach ($previewEvents->result() as $row):
				echo "<th><p>";
				echo ucfirst($row->day)."/".$row->month."/".date('Y'); 
				echo "</p><p>";
				echo $row->title;
				echo "</p><p class='loc'>";
				echo $row->location;
				echo "</p></th>";
			endforeach;
		?>
		</table>
		<br>
	</div>
<div id="container">
	<!-- navbar -->
	<div class="navbar">
		<ul class="navbar">
			<li><a href="/~mmh32/CO600/Project/index.php/home">Home</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/search">Search</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/calendar/">Events</a></li>
		</ul>
		<br>
	</div>
	<div class="signup">
	<br><br><p class="intro">Please sign up below.</p><br>
			<!-- error message which is hidden by default -->
			<p class="errormsg"><?php if (isset($errormsg)) { echo $errormsg; } ?></p>
			<p id="errormsg" class="errormsg" style="display: none;">Email address is not valid.</p>
			<!-- form for user to input their registration details using multiple types of built in HTML validation -->
			<form id="register" name="register" action="/~mmh32/CO600/Project/index.php/home/register/" onsubmit="return validateForm();" method="post">
			<table>
				<tr><td><p class="subtitle">First Name:</label></td><td class="input"><input class="input" type="text" name="firstname" id="lastname" required /></td></tr>
				<tr><td><p class="subtitle">Last Name:</p></td><td class="input"><input class="input" type="text" name="lastname" id="lastname" maxlength="32" required /></td></tr>
				<tr><td><p class="subtitle">Username:</p></td><td class="input"><input class="input" type="text" name="username" id="username" required /></td></tr>
				<tr><td><p class="subtitle">Password:</p></td><td class="input"><input class="input" type="password" name="password" id="password" maxlength="20" required /></td></tr>
				<tr><td><p class="subtitle">Email Address:</p></td><td class="input"><input class="input" id="email" type="email" name="email" id="email" required /></td></tr>
				<tr><td><p class="subtitle">Phone Number:</p></td><td class="input"><input class="input" type="number" name="phoneno" id="phoneno" required /></td></tr>
				<tr><td><p class="subtitle">School:</p></td><td class="input"><input class="input" id="study" name="study">
				</td></tr>
			</table>
				<input class="button" type="submit" name="Submit" value="Register" />
		</form>
	</div>
	<p class="footer">CO600 Project</p>
</div>
<img class="klogo" src="/~mmh32/CO600/Project/images/UoK_logo.png" align="right">
</body>
</html>