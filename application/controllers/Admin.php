<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start();

class Admin extends CI_Controller 
{
	// loads the admin panel page if the user is logged in and an admin. 
	public function index()
	{
		// load Event model.
		$this->load->model('Events_model');
		// check if user is logged in by verifying the session cookie is set.
		if ((isset($_SESSION['user_login'])) && ($this->Events_model->checkAdmin($_SESSION['user_login'])) == 1)
		{
			// if all checks are true, loads the admin panel view.
			$this->load->view('adminpanel');
		}
		// load the calendar if you're logged in, or the login page if logged out.
		else
		{
			$this->load->helper('url');
			redirect('/calendar/');
		}
	}
	// check if user is an admin, and then load the create event page.
	public function addevent()
	{
		// load Event model and query database to check admin status.
		// the user should not be able to access this button without already passing the previous admin verification.
		// however, if the user is aware of the link it can be accessed directly, so this check is to prevent that.
		$this->load->model('Events_model');
		if ((isset($_SESSION['user_login'])) && ($this->Events_model->checkAdmin($_SESSION['user_login'])) == 1)
		{	
			// load create event view.
			$this->load->view('create_event');
		}
		// load the calendar if you're logged in, or the login page if logged out.
		else
		{
			$this->load->helper('url');
			redirect('/calendar/');
		}
	}
	// create event function. obtain user input via POST, store the data in variables and store in database.
	public function create_event()
	{
		// loads Events Model, and checks if the user is an administrator. again, this is to prevent direct access by non admins via the URL.
		$this->load->model('Events_model');
		if ((isset($_SESSION['user_login'])) && ($this->Events_model->checkAdmin($_SESSION['user_login'])) == 1)
		{
			// declare variables with the user input from POST.
			$title = $this->input->post('title');
			$location = $this->input->post('location');
			$host = $this->input->post('host');
			$desc = $this->input->post('desc');
			$day = $this->input->post('day');
			$month = $this->input->post('month');
			$starttime = $this->input->post('starttime');

			// store contents of the image file in a variable, then base64 encode it to prevent loss/corruption.
			$image = file_get_contents($_FILES['image']['tmp_name']);
			$image_data = base64_encode($image);
			// call the createEvent function in the events model and pass the parameters.
			$this->Events_model->createEvent($title, $location, $host, $desc, $day, $month, $starttime, $image_data);
			$this->load->helper('url');
			redirect('/');
		}
		// redirect user to calendar / login page if they aren't logged in.
		else
		{
			$this->load->helper('url');
			redirect('/calendar/');
		}
	}
	// delete an event from the database
	public function deleteevent($eventID)
	{
		// check that the user has correct permissions
		$this->load->model('Events_model');
		if ((isset($_SESSION['user_login'])) && ($this->Events_model->checkAdmin($_SESSION['user_login'])) == 1)
		{
			// call deleteEvent function in the Events model, pass relevant eventID.
			$this->Events_model->deleteEvent($eventID);
			// redirect user to the calendar.
			$this->load->helper('url');
			redirect('/calendar/');
		}
		// if user does not have required credentials, redirect to calendar.
		else 
		{
			$this->load->helper('url');
			redirect('/calendar/');
		}
	}
	// removes all past events from the database.
	public function purgeevents()
	{
		// check user credentials
		$this->load->model('Events_model');
		if ((isset($_SESSION['user_login'])) && ($this->Events_model->checkAdmin($_SESSION['user_login'])) == 1)
		{
			// set current day and month, then call the purgeEvents function.
			$day = date('d');
			$month = date('m');
			$this->Events_model->purgeEvents($day, $month);
			// redirect user to the calendar.
			$this->load->helper('url');
			redirect('/calendar/');
		}
		// redirect user to calendar.
		else
		{
			$this->load->helper('url');
			redirect('/calendar/');
		}
	}
	// load approval page and populate with pending approvals.
	public function approval()
	{
		// check user credentials
		$this->load->model('Events_model');
		if ((isset($_SESSION['user_login'])) && ($this->Events_model->checkAdmin($_SESSION['user_login'])) == 1)
		{
			// call pendingApprovals function to retrieve data from database and store in an array.
			$data['pendingApprovals'] = $this->Events_model->pendingApprovals();
			// load view and pass data.
			$this->load->view('approval',$data);
		}
		else
		{
			// redirect user to calendar.
			$this->load->helper('url');
			redirect('/calendar/');
		}
	}
	// approve student's pending booking
	public function approvestudent($attendanceID)
	{
		// check credentials
		$this->load->model('Events_model');
		if ((isset($_SESSION['user_login'])) && ($this->Events_model->checkAdmin($_SESSION['user_login'])) == 1)
		{
			// call approveStudent function, retrieve data and load view with the data.
			$this->Events_model->approveStudent($attendanceID);
			$data['pendingApprovals'] = $this->Events_model->pendingApprovals();
			$this->load->view('approval',$data);
		}
		else
		{
			// redirect user to calendar.
			$this->load->helper('url');
			redirect('/calendar/');
		}
	}
	// remove a student's approved booking.
	public function removeStudent($attendanceID)
	{
		// verifies user's credentials.
		$this->load->model('Events_model');
		if ((isset($_SESSION['user_login'])) && ($this->Events_model->checkAdmin($_SESSION['user_login'])) == 1)
		{
			// call removeStudent function to remove student's booking, then reload the approval page.
			$this->Events_model->removeStudent($attendanceID);
			$data['pendingApprovals'] = $this->Events_model->pendingApprovals();
			$this->load->view('approval',$data);
		}
		else
		{
			// redirect to calendar.
			$this->load->helper('url');
			redirect('/calendar/');
		}
	}
}
?>