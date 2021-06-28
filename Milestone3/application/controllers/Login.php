<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	public function index()
	{
		$data['error']= "";
		$data['mention'] ="<strong> please use email to as username to log in</strong>";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$email = get_cookie('email'); //get the username from cookie
				$password = get_cookie('password'); //get the username from cookie
				if ( $this->user_model->login($email, $password) )//check username and password correct
				{
					$user_data = array(
						'email' => $email,
						'logged_in' => true 	//create session variable
					);
					$this->session->set_userdata($user_data); //set user status to login in session
					$this->load->view('home'); //if user already logined show main page
				}
			}else{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			$this->load->view('home'); //if user already logined show main page
		}
		$this->load->view('template/footer');
	}
	public function check_login()
	{

		$this->load->model('user_model');		//load user model
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod!! </div> ";
		//$data['mention'] = "<strong>\"please use email to as username to log in</strong>";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$email = $this->input->post('email'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		$remember = $this->input->post('remember'); //getting remember checkbox from login form
		if(!$this->session->userdata('logged_in')){	//Check if user already login
			if ( $this->user_model->login($email, $password) )//check username and password
			{
				$_SESSION['active_time'] = time();
				$user_data = array(
					'email' => $email,
					'logged_in' => true 	//create session variable
				);
				if($remember) { // if remember me is activated create cookie
					set_cookie("email", $email, '300'); //set cookie username
					set_cookie("password", $password, '300'); //set cookie password
					set_cookie("remember", $remember, '300'); //set cookie remember
				}

				$this->session->set_userdata($user_data); //set user status to login in session
				redirect(base_url()); // direct user home page
			}else
			{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			{
				redirect(base_url()); //if user already logined direct user to home page
			}
		$this->load->view('template/footer');
		}
	}

	public function logout()
	{
		session_destroy();
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('active_time');
		//delete login status
		redirect(base_url().'login'); // redirect user back to home
	}
}
?>
