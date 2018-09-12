<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<!-- load jQuery from Google CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	$(document).ready(function() {
		$(".errormsg").fadeOut(4500);
	});
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
		margin-left: 150px;
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
	td.input {
		width: 75%;
	}
	div.login {
		margin: 10px;
		text-align: center;
		align: center;
	}
	img.clogo {
		display: block;
		margin: auto;
		width: 150px;
		height: 100px;
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
	<div class="banner">
		<table>
		<th><img class="clogo" src="/~mmh32/CO600/Project/images/SoC_logo.jpg"></th>
		<?php
			foreach ($previewEvents->result() as $row):
				echo "<th><p>";
				echo ucfirst($row->day)."/".date('m')."/2018"; 
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
	<div class="navbar">
		<ul class="navbar">
			<li><a href="/~mmh32/CO600/Project/index.php/home">Home</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/search">Search</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/calendar/">Events</a></li>
		</ul>
		<br>
	</div>
	<div class="login">
		<br><br><p class="intro">Please log in below.</p>
		<p class="errormsg"><?php if (isset($errormsg)) { echo $errormsg; } ?></p><br><br>
		<form id="login" action="/~mmh32/CO600/Project/index.php/home/dologin/" method="post">
			<table>
				<tr><td><p class="subtitle">Username:</p></td><td class="input"><input class="input" type="text" name="username" id="username" required /></td></tr>
				<tr><td><p class="subtitle">Password:</p></td><td class="input"><input class="input" type="password" name="password" id="password" maxlength="20" required /></td></tr>
			</table><br><br>
			<input class="button" type="submit" name="Submit" value="Login" />
		</form>
		<p><a class="signup" href="/~mmh32/CO600/Project/index.php/home/signup/">Not registered? Sign up here!</a></p>
	</div>
	<p class="footer">CO600 Project</p>
</div>
<img class="klogo" src="/~mmh32/CO600/Project/images/UoK_logo.png" align="right">
</body>
</html>