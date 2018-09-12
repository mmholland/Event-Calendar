<?php
class Events_model extends CI_Model {
	// establish connection to database.
	// database credentials are stored in application/config/database.php
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	// obtain data to populate the calendar.
	// the calendar loads the rest of the current month, and the whole of the next month.
	public function getEvents($month)
	{
		// calculate the next month. a leading zero must be added as calculating a sum will remove leading zeros.
		// the databse stores the months with a leading zero, so this formatting is necessary.
		$month2 = $month + 1;
		if ($month2 < 10) { $month2 = sprintf("%02d", $month2); }
		// set current date
		$day = date('d');
		// select from database all events that fall in the aforementioned parameters (rest of current month + all of next month).
		$sql = "SELECT eventID,title,location,day,month,host,starttime,description,image FROM Events WHERE (month = '$month' AND day >= '$day') OR month = '$month2' ORDER BY month, day ASC";
		return $this->db->query($sql,$month);
	}
	// retrieve the next two events for display in the banner. this retrieves a smaller amount of data.
	public function previewEvents($month)
	{
		// calculate next month (in case there is only one event left in the current month).
		$month2 = $month + 1;
		if ($month2 < 10) { $month2 = sprintf("%02d", $month2); }
		$day = date('d');
		// obtain data from the database with the above parameters.
		$sql = "SELECT title,location,day,month FROM Events WHERE (month = '$month' AND day >= '$day') OR month = '$month2' ORDER BY month, day ASC LIMIT 2";
		return $this->db->query($sql,$month);
	}
	// create event by storing new row in database.
	public function createEvent($title, $location, $host, $desc, $day, $month, $starttime, $image_data)
	{
		$this->db->query("INSERT INTO Events(title, location, day, month, host, starttime, description, image, available, quantity) VALUES('$title','$location','$day','$month','$host','$starttime','$desc','$image_data','50','50')");
	}
	// register new user by storing details in database.
	// new users are registered with the isAdmin set to false by default.
	public function register($username, $email, $phoneno, $study, $password, $firstname, $lastname)
	{
		// hashing the password before it is stored in the database.
		$hashedpass = SHA1($password);
		$this->db->query("INSERT INTO EventUsers(username, email, phoneNo, typeofStudy, password, isAdmin, firstname, lastname) VALUES('$username','$email','$phoneno','$study','$hashedpass','0','$firstname','$lastname')");
		// send email to user confirming their registration.
		$subject = "Thanks for registering!";
		$message = "Hi ".$firstname.",\r\n\r\nThank you for registering for the Events Calendar!\r\nFeel free to browse and book any events you're interested in.\r\n\r\nRegards,\r\nEvents Team";
		$headers = 'From: events' . PHP_EOL;
		mail($email,$subject,$message,$headers);
	}
	// check user's login credentials. returns true or false depending on whether the input matches a row in the database.
	public function checkLogin($username,$password)
	{
		// select all records from database with matching username and password.
		$sql = "SELECT * FROM EventUsers WHERE username = ? AND password = '" . SHA1($password) . "'";
		$checkLogin = $this->db->query($sql,$username);
		
		// check if there is a single row, and returns true or false accordingly.
		if ($checkLogin->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	// check to see if the user is an admin by checking if the isAdmin flag is true.
	public function checkAdmin($username)
	{
		// queries database for the username and isAdmin flag
		$sql = "SELECT * FROM EventUsers WHERE username = ? AND isAdmin = 1";
		$checkAdmin = $this->db->query($sql,$username);
		// if there is a result (i.e. the user's admin status is set to true), then return true. else, return false.
		if ($checkAdmin->num_rows() == 1)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	// load the individual event page when a user clicks on an event.
	public function getEventPage($eventID)
	{
		$sql = "SELECT eventID,title,location,day,host,starttime,description,image,available,quantity FROM Events WHERE eventID = ? ORDER BY day ASC";
		return $this->db->query($sql,$eventID);
	}
	// delete the event from the database.
	public function deleteEvent($eventID)
	{
		$sql = "DELETE FROM Events WHERE eventID = ?";
		return $this->db->query($sql,$eventID);
	}
	// book an event. this stores an entry in the Attending table, with the Approved flag set to false by default.
	// users must be manually approved by an admin.
	public function bookEvent($eventID, $user, $email)
	{
		$query = $this->db->query("SELECT available FROM Events WHERE eventID = '$eventID'");
		foreach ($query->result() as $row)
		{
			$result = $row->available;
			if ($result > 0)
			{
				// email confirmation sent to user.
				$subject = "Event Booked -- Pending Approval";
				$message = "Hi ".$user.",\r\n\r\nYou have successfully booked this event.\r\nYou will receive further email confirmation when approved.\r\n\r\nRegards,\r\nEvents Team";
				$headers = 'From: events' . PHP_EOL;
				mail($email,$subject,$message,$headers);
				// user count incremented by one
				$this->db->query("UPDATE Events SET available = available - 1 WHERE eventID = '$eventID'");
				// record entered into database to record user's booking.
				$sql = "INSERT INTO Attending(eventID, username, approved) VALUES('$eventID', '$user', '0')";
				return $this->db->query($sql,$eventID);
			}
			else
			{
				exit;
			}
		}
	}
	public function checkAvailability($eventID)
	{
		$sql = "SELECT available FROM Events WHERE eventID = '$eventID' AND available > 0";
		$checkAvailability = $this->db->query($sql,$eventID);
		if ($checkAvailability->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	// check to see if user has booked this event already.
	public function checkAttending($eventID, $user)
	{
		// query database to see if a record exists of this user booking this event.
		$sql = "SELECT * FROM Attending WHERE eventID = '$eventID' AND username = '$user'";
		$checkAttending = $this->db->query($sql,$eventID);
		// returns appropriate response based on whether the record exists or not.
		if ($checkAttending->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	// unbook an event. removes user's record from the approval table.
	public function unbookEvent($eventID, $user)
	{
		$this->db->query("UPDATE Events SET available = available + 1 WHERE eventID = '$eventID'");
		$sql = "DELETE FROM Attending WHERE eventID = '$eventID' AND username = '$user'";
		return $this->db->query($sql,$eventID);
	}
	// obtain the email of a user. takes a username and outputs their corresponding email address
	public function getEmail($user)
	{
		$sql = "SELECT email FROM EventUsers WHERE username = '$user'";
		$query = $this->db->query($sql,$user);
		$result = $query->row();
		return $result->email;
	}
	// search Events table for events containing the search term. takes search term and outputs all events that match.
	public function searchEvents($category, $search)
	{
		$sql = "SELECT eventID,title,location,day,month,host,starttime,description,image FROM Events WHERE $category LIKE '%$search%' ORDER BY month ASC";
		return $this->db->query($sql,$category);
	}
	// purge events from database. deletes all past events.
	public function purgeEvents()
	{
		$day = date('d');
		$month = date('m');
		$sql = "DELETE FROM Events WHERE (day <= '$day' AND month <= '$month')";
		return $this->db->query($sql,$day);
	}
	// retrieves a list of all unapproved bookings.
	public function pendingApprovals()
	{
		$sql = "SELECT EventUsers.firstname, EventUsers.lastname, EventUsers.typeOfStudy, EventUsers.email, Attending.attendanceID, Events.title, Events.available, Events.quantity FROM ((EventUsers INNER JOIN Attending ON EventUsers.username = Attending.username) INNER JOIN Events ON Attending.eventID = Events.eventID) WHERE Attending.approved = false";
		return $this->db->query($sql);
	}
	// updates a user's approval flag to true in the Attending table.
	public function approveStudent($attendanceID)
	{
		// obtains user's information from the database to personalise the email.
		$query = $this->db->query("SELECT EventUsers.firstname, EventUsers.email, Events.title FROM ((EventUsers INNER JOIN Attending ON EventUsers.username = Attending.username) INNER JOIN Events ON Attending.eventID = Events.eventID) WHERE Attending.attendanceID = '$attendanceID'");
		// load results into variables.	
		foreach ($query->result() as $row)
		{
			$firstname = $row->firstname;
			$email = $row->email;
			$title = $row->title;
		}
		// send email to user confirming their approval.
		$subject = "Booking Approved!";
		$message = "Hi ".$firstname.",\r\n\r\nYour booking for ".$title." has been approved!\r\nWe hope you enjoy the event, check the website for more information.\r\n\r\nRegards,\r\nEvents Team";
		$headers = 'From: events' . PHP_EOL;
		mail($email,$subject,$message,$headers);
		// update Attending table to set the user's approved flag to true.
		$sql = "UPDATE Attending SET approved = 1 WHERE attendanceID = '$attendanceID'";
		return $this->db->query($sql,$attendanceID);
	}
	// returns a list of students that are approved for an individual event.
	// outputs their name, school, and email.
	public function attendingStudents($eventID)
	{
		$sql = "SELECT EventUsers.firstname, EventUsers.lastname, EventUsers.typeOfStudy, EventUsers.email, Attending.attendanceID, Events.title FROM ((EventUsers INNER JOIN Attending ON EventUsers.username = Attending.username) INNER JOIN Events ON Attending.eventID = Events.eventID) WHERE Attending.approved = true AND Events.eventID = '$eventID';";	
		return $this->db->query($sql,$eventID);
	}
	// unapproves a student's booking.
	public function removeStudent($attendanceID)
	{
		// obtain user's information to personalise the email.
		$query = $this->db->query("SELECT EventUsers.firstname, EventUsers.email, Events.title FROM ((EventUsers INNER JOIN Attending ON EventUsers.username = Attending.username) INNER JOIN Events ON Attending.eventID = Events.eventID) WHERE Attending.attendanceID = '$attendanceID'");
		// load result into variables.
		foreach ($query->result() as $row)
		{
			$firstname = $row->firstname;
			$email = $row->email;
			$title = $row->title;
		}
		// send email to user informing them of their booking cancellation.
		$subject = "Booking Removed!";
		$message = "Hi ".$firstname.",\r\n\r\nYour booking for ".$title." has been removed!\r\nWe're sorry, we hope you can browse our events and find another to enjoy instead.\r\n\r\nRegards,\r\nEvents Team";
		$headers = 'From: events' . PHP_EOL;
		mail($email,$subject,$message,$headers);
		// updates approved flag in the Attending table to false.
		$sql = "UPDATE Attending SET approved = 0 WHERE attendanceID = '$attendanceID'";
		return $this->db->query($sql,$attendanceID);
	}
	public function checkUser($username)
	{
		$sql = "SELECT * FROM EventUsers WHERE username = '$username'";
		return $this->db->query($sql,$username);
	}
		public function checkEmail($email)
	{
		$sql = "SELECT * FROM EventUsers WHERE email = '$email'";
		return $this->db->query($sql,$email);
	}
}
