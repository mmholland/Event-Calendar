<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>School of Computing Internationalisation Events Calendar</title>

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
		border-top: 1px solid #005DA7;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	#container {
		margin: 10px;
		border: 1px solid #005DA7;
		box-shadow: 0 0 8px #005DA7;
	}
	div.navbar {
		margin: 10px;
		border: 1px solid #005DA7;
		text-align: center;
	}
	ul {
		list-style: none;
		width: 100%;
		height: 100%;
		padding: 0;
		margin: 0;
	}
	ul li {
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
	p.intro {
		text-align: center;
		font-size: 20pt;
		color: #005DA7;
		width: 65%;
		align: center;
		margin: 0 auto;
	}
	table {
		table-layout: fixed;
		width: 100%;
	}
	td {
		word-wrap: break-word;
		text-align: center;
		padding-bottom: 1em;
		padding-top: 1em;
		font-size: 30px;
	}
	a {
		text-decoration: none;
		font-size: 30px;
	}
	div.banner {
		text-align: center;
		line-height: 0.4;
	}
	div p.loc {
		font-style: italic;
	}
	.button {
		background-color: #2164d1;
		color: white;
		padding: 10px 80px;
		text-align: center;
		font-size: 32px;
		border-radius: none;
		border: none;
		width: 65%;
		height: 100px;
		display: block;
		margin: 0 auto;
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
	<div class="navbar">
		<ul class="navbar">
			<li><a href="/~mmh32/CO600/Project/index.php/home/search">Search</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/calendar">Events</a></li>
			<li><?php if (isset($_SESSION["user_login"])) { echo "<a href='/~mmh32/CO600/Project/index.php/home/logout'>Logout</a>"; } else { echo "<a href='/~mmh32/CO600/Project/index.php/home/login'>Login</a>"; } ?></li>
		</ul>
		<br>
	</div>
	<div id="body">
		<br><br>
		<p class="intro">Welcome to the Events Calendar for the School of Computing Internationalisation Events Calendar!</p><br><br>
		<p class="intro">On this website you can browse and register for our upcoming events. You'll receive email confirmation when your booking is approved. If you haven't already signed up, click the button below!</p><br><br>
		<div class="button"><form id='register' action='/~mmh32/CO600/Project/index.php/home/signup/' method='POST'><input class='button' type='submit' name='register' value='Register Now!' /></form></div><br>
	</div>
	<p class="footer">CO600 Project</a></p>
</div>
<img class="klogo" src="/~mmh32/CO600/Project/images/UoK_logo.png" align="right">
</body>
</html>