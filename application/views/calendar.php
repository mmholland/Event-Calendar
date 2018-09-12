<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Events Calendar</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	// changes colour of the text when an event is hovered over.
	// background colour is changed using css.
	$(document).ready(function() {
		$('a').hover(function(){
			$(this).css("color", "white");
		}, function() {
			$(this).css("color", "black");
		});
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
		padding: 0;
	}
	p.footer {
		text-align: center;
		border-top: 1px solid #2164d1;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	p.intro {
		color: #2164d1;
		font-family: Arial, sans-serif;
		text-align: center;
	}
	table {
		table-layout: fixed;
		width: 800px;
		margin-left: auto;
		margin-right: auto;
	}
	td.event {
		vertical-align: top;
		border: 1px solid #2164d1;
		word-wrap: break-word;
		text-align: center;
		width: 400px;
	}
	td:hover.event {
		background-color: #2164d1;
	}
	a {
		text-decoration: none;
		color: black;
	}
	td a:hover .event {
		color: white;
	}
	img.eventlogo {
		width: 400px;
		height: 200px;
	}
	div.calendar {
		align: center;
	}
	p.info {
		text-align: left;
		margin-left: 25px;
		margin-right: 25px;
	}
	p.date {
		text-align: right;
		margin-right: 25px;
		font-weight: bold;
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
	.location {
		font-style: italic;
	}
	.title {
		font-weight: bold;
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
	div p.loc {
		font-style: italic;
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
		<th class="banner"><p class="banner"><?php echo date('F'); ?></p></th>
		<th class="banner"><p class="banner"><?php echo date('Y');?></p></th>
		</table>
		<br>
	</div>
<div id="container">
	<div class="navbar">
		<ul class="navbar">
			<li><a href="/~mmh32/CO600/Project/index.php/home">Home</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/search">Search</a></li>
			<li><?php if (isset($_SESSION["user_login"])) { echo "<a href='/~mmh32/CO600/Project/index.php/home/logout'>Logout</a>"; } else { echo "<a href='/~mmh32/CO600/Project/index.php/home/login'>Login</a>"; } ?></li>
		</ul>
		<br>
	</div>
	<div class="calendar">
	<p class="intro"><br>Welcome to the School of Computing Internationalisation Events Calendar.</p><br>
		<table>
			<?php
			$count = 0;
			foreach ($loadEvents->result() as $row):
				if ($count % 2 == 0)
				{
					echo "</tr>";
				}
				echo "<td class='event'><a class='event' href='/~mmh32/CO600/Project/index.php/home/event/".$row->eventID."'>";
				$encoded_image = $row->image; echo "<img class='eventlogo' src='data:image/jpeg;base64,{$encoded_image}' alt='jpg'>"; 
				echo "<br><p class='date'>";
				echo $row->day."/".$row->month;
				echo "</p>";
				echo "<p class='info'><span class='title'>";
				echo $row->title;
				echo "</span><br><span class='location'>";
				echo $row->location;
				echo "</span><br>";
				echo $row->description;
				echo "</p></a></td>";
				$count++;
			endforeach; 
			echo "</tr>";
			?>
			<!-- this code creates an invisible row to maintain the integrity of the table if there are less than 2 results of a search. -->
			<tr><td></td><td></td></tr>
		</table>
	</div>
	<p class="footer">CO600 Project <?php if (isset($_SESSION["user_login"])) { if ($this->Events_model->checkAdmin($_SESSION['user_login']) == 1) { echo "- <a href='/~mmh32/CO600/Project/index.php/admin/'>Admin</a>"; } }	?></p>
</div>
<img class="klogo" src="/~mmh32/CO600/Project/images/UoK_logo.png" align="right">
</body>
</html>