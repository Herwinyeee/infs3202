<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->helper('url_helper');
    }

    public function index() {
        $this->load->view('style');
        if (!isset($_SESSION["email"])) {
            redirect("/login");
        }
        $email = $_SESSION["email"];
        $data = array("item"=>null);
        $data['item'] = $this->items_model->show_cart($email);
        $this->load->view('template/header');
        $this->load->view('cart', $data);
        $this->load->view('template/footer');
    }

    public function addCart() {
        if (!isset($_SESSION["email"])) {
            redirect("/login");
        }
        $email = $_SESSION["email"];
        $itemId = $this->input->post('itemid');
        $cartId = uniqid();
        $this->items_model->add_cart($itemId, $email, $cartId);
        redirect("/cart");
    }

    public function remove() {
        if (!isset($_SESSION["email"])) {
            redirect("/login");
        }
        
        $email = $this->session->userdata('email');
        //$email = $_SESSION["email"];
        $itemId = $this->input->post('itemid');
        echo $itemId;
        $this->items_model->remove($itemId, $email);
        redirect("/cart");
    }

}