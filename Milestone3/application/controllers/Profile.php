<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('url_helper');
        $this->load->helper(array('form', 'url'));
        // $data['region'] = "";
        // $this->data['region'] = "";

        if($this->session->userdata('email')!==null){
            $this->data['email'] = $this->session->userdata('email');
            $this->data['username'] = $this->user_model->get_user_info($this->data['email'])['username'];
            $this->data['verify_code'] = $this->user_model->get_user_info($this->data['email'])['verify_code'];
            $this->data['region'] = $this->user_model->get_user_info($this->data['email'])['region'];

        }else{
            redirect('login/');
        }

    }
    public function index(){
        $data['success'] ="";
        if(!isset($_SESSION['email'])){
            redirect(base_url().'login/');
        }
        $email = $_SESSION['email'];
        $this->data = $this->user_model->get_user_info($email);
        $this->load->view('style');
        $this->load->view('template/header');
        $this->load->view('profile',$this->data);
        $this->load->view('google-maps');
        $this->load->view('location');
        $this->load->view('template/footer');  
       
    }
    public function update_name(){
        $data['success'] ="";
        $this->load->view('style');
        $username = $this->input->post('name');
        $email = $_SESSION['email'];
        $this->user_model->update_username($email,$username);
        redirect(base_url().'profile');
    }
    public function do_upload(){
        $unique_code = $this->user_model->get_user_info($this->session->userdata('email'))['verify_code'];
        $new_name = $unique_code . "_profile.jpg";
        $config[''] = $new_name;
        $config = array(
            'upload_path' => "uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "8048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "10000",
            'max_width' => "10000",
            'file_name' => $new_name
        );
        $this->load->library('upload', $config);
        if($this->upload->do_upload('userfile')) {
            $data = array('upload_data' => $this->upload->data());
            //$data['success'] = "you have change and upload your photo successfully!!!";
            // redirect("/profile");
            $this->load->view('template/header');
            $this->load->view('upload_success',$data);
            $this->load->view('profile',$this->data);
            $this->load->view('template/footer');

        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->data['error'] = $error;
            $this->index();
            // $this->load->view('template/header');
            // $this->load->view('profile',$this->data);
            // $this->load->view('upload_form', $error);
            // $this->load->view('template/footer');
        }
    } 
    public function setRegion(){
        $this->data['region'] = $this->input->post('country');
        $location = $this->input->post('country');
        $email = $_SESSION['email'];
        $this->user_model->update_location($email,$location);
        redirect(base_url().'profile');

    }   



}
