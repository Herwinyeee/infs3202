<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class password extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->data['status'] = "";
        $this->data['status1'] = "";
         $this->data['show'] = false;
         $this->data['email'] = "";
        $this->load->model('user_model');
        $this->data['repeat'] ="";
    }

    public function index(){
        
        $this->load->view('template/header');
        $this->load->view('password',$this->data);
        $this->load->view('template/footer');


    }
    public function sendTokens() {
        $email = $this->input->get('email');

        $tokens = "" . rand(0,9) . rand(0,9). rand(0,9). rand(0,9). rand(0,9).rand(0,9);

        $this->user_model->send_tokens($email, $tokens);

        $this->load->library('email');
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'mailhub.eait.uq.edu.au';
            $config['smtp_port'] = 25;
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE; 
            $this->email->initialize($config);
            $this->email->from('password@infs3202-b47e29e6.uqcloud.net', 'lets do shopping');

            $this->email->subject('Change your password!');
            $message= /*-----------email body starts-----------*/
                '<h2>Hello!</h2><br><br>
            
                This is your reset token <br>
                You can use to change your password.<br>
                -------------------------------------------------<br><br>
                Reset token   : ' .  $tokens . '<br>
                -------------------------------------------------<br><br>';
                /*-----------email body ends-----------*/
            $this->email->message($message);
            $this->email->to($email);
            $this->email->send();
            print_r($this->email->print_debugger());

        $this->data['status'] = "Please check the reset tokens in your email";
        $this->data['email'] = $email;
        $this->data['show'] = TRUE;
        redirect(base_url(). "password/updatePass/" . $email);
    }
    public function updatePass($email){
        if (!isset($email)) {
            $this->index();
        }
        $this->data['show'] = true;
        $this->data['email'] = $email;
        $this->load->view('template/header');
        $this->load->view('password', $this->data);
        $this->load->view('template/footer');
        
    }
    public function show_result(){
        $tokens = $this->input->post('tokens');
        $password = $this->input->post('password');
        $repeatpass = $this->input->post('re-password');
        $email = $this->input->post('email');
        if(!$this->user_model->compare($password,$repeatpass)){
            $this->data['repeat'] = "two passwords are not same!!!";
            $this->data['show'] = true;
            $this->data['email'] = $email;
            $this->index();
        }else if (strlen($password) < 6) {
            $this->data['status1'] = "Password should be longer than six letters";
            $this->data['show'] = true;
            $this->data['email'] = $email;
            $this->index();
        } else if ($this->user_model->update_password($email, $tokens, $password)) {
            redirect(base_url(). "login/");
        } else {
            $this->data['status1'] = "Token is not correct, please check again.";
            $this->data['show'] = true;
            $this->data['email'] = $email;
            $this->index();
        }
    }
}
?>