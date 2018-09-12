<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Event Page</title>

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
		width: 150px;
		height: 100px;
	}
	img.eventlogo {
		width: 100%;
		max-width: 650px;
		length: 100%;
		max-length: 350px;
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
		text-align: left;
		margin-left: 200px;
		margin-right: 150px;
		font-size: 40px;
	}
	p.desc {
		text-align: left;
		margin-left: 200px;
		margin-right: 150px;
		font-size: 24px;
	}
	p.img {
		margin-left: 50px;
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
	.input {
		width: 60%;
		padding: 6px 0px;
	}	
	table {
		padding: 10px;
		table-layout: fixed;
		width: 100%;
		margin-left: auto;
		margin-right: auto;
	}
	}
	ul.eventinfo {
		list-style: none;
		width: 100%;
		height: 100%;
		padding: 0;
		margin: 0;
	}
	ul.eventinfo li {
		float: left;
		text-align: center;
		height: 100%;
		width: 50%;
	}
	div.events {
		margin: 10px;
		text-align: center;
	}
	div.docs {
		margin: 10px;
		text-align: center;
		border: 1px solid #2164d1;
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
	.removebutton
	{
		background-color: #2164d1;
		color: white;
		padding: 10px 20px;
		text-align: center;
		margin: 10px;
		font-size: 16px;
		border-radius: none;
		border: none;
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
		td {
		width: 25%;
		align: center;
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
			<li><a href="/~mmh32/CO600/Project/index.php/home">Home</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/search">Search</a></li>
			<li><a href="/~mmh32/CO600/Project/index.php/home/calendar/">Events</a></li>
			<li><li><?php if (isset($_SESSION["user_login"])) { echo "<a href='/~mmh32/CO600/Project/index.php/home/logout'>Logout</a>"; } else { echo "<a href='/~mmh32/CO600/Project/index.php/home/login'>Login</a>"; } ?></li></li>
		</ul>
		<br>
	</div>
	<div class="events">
	<br>
	<p class="info">
		Hosted by: <?php foreach ($loadEvents->result() as $row): echo $row->host; ?> <br>
		Start time: <?php echo $row->starttime; ?> <br>
		Location: <?php echo $row->location; ?> <br>
		Availability: <?php echo $row->available."/".$row->quantity; ?> <br>
	</p>
	<p class="title"><?php $encoded_image = $row->image; echo "<img class='eventlogo' src='data:image/jpeg;base64,{$encoded_image}' alt='jpg'>"; ?><br><br><?php echo $row->title; endforeach; ?></p>
	<p class="desc"><?php echo $row->description; ?></p><br><br>
	<?php
	if (($this->Events_model->checkAvailability($row->eventID) == 0) && ($this->Events_model->checkAttending($row->eventID,$_SESSION['user_login']) == 0))
	{
		echo "<p class='booked'>Event fully booked!</p>";
	}
	else if ($this->Events_model->checkAttending($row->eventID,$_SESSION['user_login']) == 0) 
	{
		echo "<form id='bookevent' action='/~mmh32/CO600/Project/index.php/home/bookevent/".$row->eventID."' method='POST'>";
		echo "<input class='button' type='submit' name='Submit' value='Book Event' />";
	}
	else
	{
		echo "<form id='unbookevent' action='/~mmh32/CO600/Project/index.php/home/unbookevent/".$row->eventID."' method='POST'>";
		echo "<input class='button' type='submit' name='Submit' value='Unbook Event' />";
	}
	?>
	</form>
	<br>
	<br>
	</div>
	<?php if ($this->Events_model->checkAdmin($_SESSION['user_login']) == 1) {
		echo "<div class='admin'><p class='title'>Approved Students</p><br><table>";
		echo "<th>First Name</th><th>Last Name</th><th>School</th><th>Email</th><th>Remove?</th>";
			foreach ($attendingStudents->result() as $row):
				echo "<tr><td align='center'><p>".ucfirst($row->firstname)."</p></td>";
				echo "<td align='center'><p>".$row->lastname."</p></td>";
				echo "<td align='center'><p>".$row->typeOfStudy."</p></td>";
				echo "<td align='center'><p>".$row->email."</p></td>";
				echo "<td align='center'><form id='adminpanel' action='/~mmh32/CO600/Project/index.php/admin/removestudent/".$row->attendanceID."/'><input class='removebutton' type='submit' name='Submit' value='Remove' method='post'/></form></td></tr>";
			endforeach;
	}
	?>
		</table>
		<br>
	</div>
	<?php if (isset($errormsg)) { echo $errormsg; } ?>
	<p class="footer">CO600 Project <?php if ($this->Events_model->checkAdmin($_SESSION['user_login']) == 1) { foreach ($loadEvents->result() as $row): echo "- <a href='/~mmh32/CO600/Project/index.php/admin/deleteevent/".$row->eventID."'>Delete Event</a>"; endforeach; } ?></p>
<img class="klogo" src="/~mmh32/CO600/Project/images/UoK_logo.png" align="right">
</div>
</body>
</html>