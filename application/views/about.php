<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>About</title>

	<style type="text/css">
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
	}
	p.intro {
		text-align: center;
	}
	table {
		padding: 10px;
		table-layout: fixed;
		width: 100%;
	}
	td {
		border: 1px solid #2164d1;
		word-wrap: break-word;
		text-align: center;
	}
	a {
		text-decoration: none;
	}
	</style>
</head>
<body>

<div id="container">
	<div class="navbar">
		<ul class="navbar">
			<li><a href="/~mmh32/CO600/Project/index.php/home">Home</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/calendar">Events</a></li>
			<li><?php if (isset($_SESSION["user_login"])) { echo "<a href='/~mmh32/CO600/Project/index.php/home/logout'>Logout</a>"; } else { echo "<a href='/~mmh32/CO600/Project/index.php/home/login'>Login</a>"; } ?></li>
		</ul>
		<br>
	</div>
	<img class="clogo" src="/~mmh32/CO600/Project/images/SoC_logo.jpg">
	<div id="body">
		<p class="intro">Welcome to the Events Calendar for the School of Computing's Internationalisation Department. To book an event, please sign up or login using the link at the top of the page. Through this website you can browse all upcoming events, and book them online with automatic email updates. <br><br>Text about what the school does etc goes here...</p>
	</div>
	<p class="footer">CO600 Project</p>
</div>
<img class="klogo" src="/~mmh32/CO600/Project/images/UoK_logo.png" align="right">
</body>
</html>