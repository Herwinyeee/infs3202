<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->library('image_lib');
    }
    public function index(){
        $this->load->view('style');
        $this->load->view('template/header');
        $this->load->view('post');
        $this->load->view('template/footer');

    }
    public function check_post(){
        if(!isset($_SESSION['email'])){
            redirect(base_url().'login');
        }
        $item_name = $_GET['itemname'];
        $item_price = $_GET['itemprice'];
        $decription = $_GET['description'];
        $image="img/mac.png";
        $hide = $_GET['hide'];
        $status = 0;
        if($hide){
            $status = 1;
        }
        /** pocessing image**/
        $config['image_library'] = 'gd2';
        $config['source_image'] = base_url().'img/mac.png';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']     = 75;
        $config['height']   = 50;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        if ( ! $this->image_lib->resize())
        {
            echo $this->image_lib->display_errors("error");
        }


        $item_id = uniqid();
        $this->items_model->post_item($item_id,$item_name,$item_price,$decription,$image,$status);
        redirect(base_url()."item/load/". $item_id);
    }
}