<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->data['status'] = "";
        $this->data['exist'] = "";
        $this->data['error'] ="";

    }

    public function index() {
    	$this->load->view('template/header');
        $this->load->view('register', $this->data);
        $this->load->view('template/footer');
    }

    public function submit() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $name = $this->input->post('username');
        if (strlen($password) < 6) {
            $this->data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> password should longer than 6 !! </div> ";;
            $this->index();
            
        } else if ($this->user_model->is_exist($email)) {
            $this->data['exist'] = "<div class=\"alert alert-danger\" role=\"alert\"> email was existed!! </div> ";
            $this->index();
        } else {
            
            $captcha_response = trim($this->input->post('g-recaptcha-response'));

            if($captcha_response != '')
            {
                $keySecret = '6Lfi67waAAAAAL2wAAYP2Wq2Jqf5Y56BIpiDpJjc';

                $check = array(
                    'secret'		=>	$keySecret,
                    'response'		=>	$this->input->post('g-recaptcha-response')
                );

                $startProcess = curl_init();

                curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");

                curl_setopt($startProcess, CURLOPT_POST, true);

                curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));

                curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);

                curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);

                $receiveData = curl_exec($startProcess);

                $finalResponse = json_decode($receiveData, true);

                if($finalResponse['success'])
                {
                    $code = uniqid();
                    $this->load->library('email');
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'mailhub.eait.uq.edu.au';
                    $config['smtp_port'] = 25;
                    $config['mailtype'] = 'html';
                    $config['charset'] = 'iso-8859-1';
                    $config['wordwrap'] = TRUE; 
                    $this->email->initialize($config);
                    $this->email->from('admin@infs3202-b47e29e6.uqcloud.net', "Lets do shopping");

                    $this->email->subject("Welcome to "."Lets do shopping");
                    $message= /*-----------email body starts-----------*/
                        '<h2>Thanks for signing up, '. $name.'!</h2><br><br>
                    
                        Your account has been created. <br>
                        Here are your login details.<br>
                        -------------------------------------------------<br><br>
                        Email   : ' .  $email . '<br>
                        -------------------------------------------------<br><br>
                                        
                        Please click this link to activate your account:<br>
                        ' . base_url() . 'register/verify/' . $code ;
                        /*-----------email body ends-----------*/
                    $this->email->message($message);
                    $this->email->to($email);
                    $this->email->send();
                    print_r($this->email->print_debugger());
                    $this->data['status'] = "We have sent you an email, please check and active it";
                    // $storeData = array(
                    //     'email'	=>	$this->input->post('email'),
                    //     'username'		=>	$this->input->post('username'),
                    //     'password'			=>	$this->input->post('password'),
                    //     'verify_code'       => $code
                    // );

                    //$this->user_model->insert($storeData);
                    $this->user_model->create_account($email, $password, $name, $code);

                    $this->session->set_flashdata('success_message', 'Email sent Successfully');

                    //redirect(base_url().'register');
                    $this->index();
                }
                else
                {
                    $this->session->set_flashdata('message', 'Validation Fail Try Again');
                    redirect(base_url().'register');
                }
            }
            else
            {
                $this->session->set_flashdata('message', 'Validation Fail Try Again');

                redirect(base_url().'register');
            }
        }
    }

    public function verify($code = NULL) {
        if ($code == NULL) {
            $this->index;
        }
        $this->user_model->active($code);
        $this->data['status'] = "Thank you, your account has been activated, please go to login page";
        // $this->data['success'] = "Thank you, your account has been activated, please go to log in page";
        
        $this->index();
        // redirect(base_url().'login'.$email);
    }

    /****************recaptcha*******************/
    
    public function validate()
	{
		$captcha_response = trim($this->input->post('g-recaptcha-response'));

		if($captcha_response != '')
		{
			$keySecret = '6LefzNYZAAAAABWAiYy2_X2OiBSZkXdT7K-OoaKW';

			$check = array(
				'secret'		=>	$keySecret,
				'response'		=>	$this->input->post('g-recaptcha-response')
			);

			$startProcess = curl_init();

			curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");

			curl_setopt($startProcess, CURLOPT_POST, true);

			curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));

			curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);

			$receiveData = curl_exec($startProcess);

			$finalResponse = json_decode($receiveData, true);

			if($finalResponse['success'])
			{
				$storeData = array(
					'first_name'	=>	$this->input->post('first_name'),
					'last_name'		=>	$this->input->post('last_name'),
					'age'			=>	$this->input->post('age'),
					'gender'		=>	$this->input->post('gender')
				);

				$this->captcha_model->insert($storeData);

				$this->session->set_flashdata('success_message', 'Data Stored Successfully');

				redirect('captcha');
			}
			else
			{
				$this->session->set_flashdata('message', 'Validation Fail Try Again');
				redirect('captcha');
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Validation Fail Try Again');

			redirect('captcha');
		}
	}


    

    // public function process(){
    //     $this->load->view('template/header');
    //     $this->load->view('register', $this->data);
    //     if(isset($_POST["email"])){
    //         $username_error ='';
    //         $password_error = '';
    //         $email_error ='';
    //         $captcha_error='';
    //     }
    //     if(empty($_POST['g-recaptcha-response']))
    //     {
    //         $captcha_error = 'Captcha is required';
    //     }
    //     else
    //     {
    //         $secret_key ='6Lfi67waAAAAAL2wAAYP2Wq2Jqf5Y56BIpiDpJjc';
    //         $response = file_get_contents('https://www.google.com/
    //         recaptcha/api/siteverify?secret='.$secret_key .'&response='.$_POST['g-recaptcha-response']);

    //         $response_data = json_decode($response);
    //         if(!$response_data->success)
    //         {
    //             $captcha_error='Captcha verification failed';
    //         }
    //     }
    //     if($password_error==''&& $username_error==''&& $email_error=''
    //     && $captcha_error =='')
    //     {
    //         $data = array(
    //             'success'=>true
    //         );
    //     }
    //     else
    //     {
    //         $data = array(
    //             'username_error' =>$username_error,
    //             'password_error' => $password_error,
    //             'email_error' => $email_error ,
    //             'captcha_error' => $captcha_error
    //         );

    //     }
    //     echo json_encode($data);
    //     $this->load->view('template/footer');
        
    // }
}

?>    