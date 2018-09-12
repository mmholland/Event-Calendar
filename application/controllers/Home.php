<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	session_start();

class Home extends CI_Controller {
	// load homepage, populate banner with event preview.
	public function index()
	{
		// load Event model, call previewEvents function by passing the current month.
		$month = date('m');
		$this->load->model('Events_model');
		$data['previewEvents'] = $this->Events_model->previewEvents($month);
		$this->load->view('homepage',$data);
	}
	// load login page, populate banner with event preview.
	public function login()
	{
		// load Event model, call previewEvents function by passing the current month.
		$month = date('m');
		$this->load->model('Events_model');
		$data['previewEvents'] = $this->Events_model->previewEvents($month);
		$this->load->view('login',$data);
	}
	// perform login, verify user's credentials and set a session cookie if their credentials are valid, otherwise reload the login with
	// an appropriate error message.
	public function doLogin()
	{
		// load users model
		$this->load->model('Events_model');
		// obtain username from form via POST method
		$username = $this->input->post('username');
		// obtain password from form via POST method
		$password = $this->input->post('password');
		// run checkLogin method with user credentials
		$auth = $this->Events_model->checkLogin($username, $password);
		if ($auth == true)
		{
			// set user session as their username
			$_SESSION["user_login"] = $username;
			// redirect user to their page
			$this->load->helper('url');
			redirect('/calendar/');
		}
		else
		{
			$month = date('m');
			// if credientials are incorrect, redirect to login page with error message
			$data['errormsg'] = "Username and/or password are not recognised.";
			$data['previewEvents'] = $this->Events_model->previewEvents($month);
			$this->load->view('login',$data);
		}
	}
	// 
	public function logout()
	{
		// log user out by unsetting the user_login session variable, and destroying the session.
		// user is then redirected to the login page.
		unset($_SESSION["user_login"]);
		session_destroy();
		$this->load->helper('url');
		redirect('/login/');
	}
	// load the calendar view. retrieve the data to pass to it through the Event Model.
	public function calendar()
	{
		// checks to see if user is logged in so that only registered users can view the calendar.
		if (isset($_SESSION["user_login"]))
		{	
			// call getEvents function in the Events Model to retrieve data from the database to populate the calendar.
			$month = date('m');
			$this->load->model('Events_model');
			$data['loadEvents'] = $this->Events_model->getEvents($month);
			$this->load->view('calendar',$data);
		}
		// if user is not logged in, redirect them to the login.
		else
		{
			$this->load->helper('url');
			redirect('/login/');
		}
	}
	// load the signup page with the banner populated with event previews.
	public function signup()
	{
		$month = date('m');
		$this->load->model('Events_model');
		$data['previewEvents'] = $this->Events_model->previewEvents($month);
		$this->load->view('signup',$data);
	}
	// retrieve user input via POST, declare it in variables and call the register function with these parameters.
	public function register()
	{	
		$this->load->model('Events_model');
		$username = $this->input->post('username');
		// check if username already exists in the database
		$checkUser = $this->Events_model->checkUser($username);
		if ($checkUser->num_rows() == 0)
		{
			$email = $this->input->post('email');
			// checks if email already exists in the database
			$checkEmail = $this->Events_model->checkEmail($email);
			if ($checkEmail->num_rows() == 0)
			{
				$firstname = $this->input->post('firstname');
				$lastname = $this->input->post('lastname');
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$phoneno = $this->input->post('phoneno');
				$study = $this->input->post('study');
				$this->Events_model->register($username, $email, $phoneno, $study, $password, $firstname, $lastname);
				// redirect user to login page so they can now log in.
				$this->load->helper('url');
				redirect('/login/');
			}
			else
			{
				// create error message.
				$data['errormsg'] = "There is already an account with that email address.";
				// retrieve event preview.
				$month = date('m');
				$data['previewEvents'] = $this->Events_model->previewEvents($month);
				// load search page with error message.
				$this->load->view('signup',$data);
			}
		}
		else
		{
			$data['errormsg'] = "Sorry, this username is unavailable.";
			// retrieve event preview.
			$month = date('m');
			$data['previewEvents'] = $this->Events_model->previewEvents($month);
			// load search page with error message.
			$this->load->view('signup',$data);
		}
	}
	// load specific event page by passing an eventID.
	public function event($eventID)
	{
		// checks if user is logged in.
		if (isset($_SESSION["user_login"]))
		{
			// retrieves required data from Events model and passes it to the view.
			// loads a list of approved students, the event information itself, and the banner information.
			$this->load->model('Events_model');
			$data['attendingStudents'] = $this->Events_model->attendingStudents($eventID);
			$data['loadEvents'] = $this->Events_model->getEventPage($eventID);
			$month = date('m');
			$data['previewEvents'] = $this->Events_model->previewEvents($month);
			$this->load->view('event',$data);
		}
		// if the user isn't logged in, and is trying to access the event via the URL, they will be redirected to the login page.
		else
		{
			$this->load->helper('url');
			redirect('/login/');
		}
	}
	// book an event. first the getEmail function is called, to obtain the user's email address ready to call the bookEvent function,
	// which requires the email address to send a mail.
	public function bookevent($eventID)
	{
		// checks if user is logged in.
		if (isset($_SESSION["user_login"]))
		{
			// determine username from the session variable, and call getEmail function.
			$this->load->model('Events_model');
			$user = $_SESSION["user_login"];
			$email = $this->Events_model->getEmail($user);
			// call bookEvent function.
			$this->Events_model->bookEvent($eventID, $user, $email);
			// reload the event page.
			$this->load->helper('url');
			redirect('/event/'.$eventID);
		}
		// if the user isn't logged in, loads the login page.
		else
		{
			$this->load->helper('url');
			redirect('/login/');
		}
	}
	// unbook an event. this does not send an email confirmation therefore doesn't need the user's email address.
	public function unbookEvent($eventID)
	{
		// check if user is logged in
		if (isset($_SESSION["user_login"]))
		{
			// determine user's username.
			$this->load->model('Events_model');
			$user = $_SESSION["user_login"];
			// call unbookEvent function and reload the page.
			$this->Events_model->unbookEvent($eventID, $user);
			$this->load->helper('url');
			redirect('/event/'.$eventID);
		}
		// load login page if the user is not logged in.
		else
		{
			$this->load->helper('url');
			redirect('/login/');
		}
	}
	// load search page, call previewEvents function to populate banner.
	public function search()
	{
		$month = date('m');
		$this->load->model('Events_model');
		$data['previewEvents'] = $this->Events_model->previewEvents($month);
		$this->load->view('search',$data);
	}
	// doSearch function. retrieves input by POST and queries the database for matching events.
	public function doSearch()
	{
		$this->load->model('Events_model');
		// retrieve user input by POST.
		$category = $this->input->post('category');
		$search = $this->input->post('search');
		// validation. checks to see if there are 0 results, and if so, displays an appropriate error message.
		$checkResults = $this->Events_model->searchEvents($category, $search);
		if ($checkResults->num_rows() == 0)
		{
			// declare error message.
			$data['errormsg'] = "Sorry, no results found for '".$search."'!";
			// retrieve event preview.
			$month = date('m');
			$data['previewEvents'] = $this->Events_model->previewEvents($month);
			// load search page with error message.
			$this->load->view('search',$data);
		}
		// display results in the calendar view.
		else
		{
			$data['loadEvents'] = $this->Events_model->searchEvents($category, $search);
			$this->load->view('calendar',$data);
		}
	}
}