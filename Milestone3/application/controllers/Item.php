<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('items_model');
        $this->load->helper('url_helper');
        
    }

    public function index() {
        $this->load->view('style');
        $this->load->view('template/header');
        $this->load->view('itemdetail',  $this->data);
        $this->load->view('template/footer');   
    }

    public function load($item_id=NULL) {
        if(!isset($_SESSION['email'])){
            redirect(base_url().'login');
        }
        if($item_id==NULL){
            if(isset($_GET['itemid'])){
                $item_id = $_GET['itemid'];
            }else{
                redirect(base_url());
            }
        }
        $this->data = $this->items_model->load($item_id);
        
        if($this->data['status'] == 1){
            $this->data['sellerEmail'] = "Hidden";
        }else{
            if(isset($_SESSION['email'])){
             $this->data['sellerEmail'] = $_SESSION['email'];
            }else{
             $this->data['sellerEmail'] = "none";

            }
        }
        $this->data['itemid'] = $item_id;
        $this->data['itemName'] = $this->items_model->get_name($item_id);
        $this->data['price'] = $this->items_model->get_price($item_id);
        $this->data['description'] = $this->items_model->get_des($item_id);
        $this->data['rating'] = $this->items_model->get_ave_rating($item_id);
        $this->data['comment'] = $this->items_model->show_comment($item_id);
        $this->index();

    }
    public function submit() {
        if (!isset($_SESSION["email"])) {
            redirect('/login');
        }
        $rating = $_GET['rating'];
        $comment = $_GET['comment'];
        $itemId = $_GET['itemid'];
        $ratingId = uniqid();
        $this->items_model->add_comment($ratingId, $itemId, $rating, $comment);
        redirect("/item/load/".$itemId);
    }
}