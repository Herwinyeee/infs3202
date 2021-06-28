<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->helper('url_helper');
    }

    public function index() {
        $data = array("keywords"=>null, "item"=>null);
        $keywords = $this->input->get('search');
        if(isset($keywords)){
			$data['item'] = $this->items_model->search($keywords);
		}
        $this->load->view('template/header');
        $this->load->view('search', $data);
        $this->load->view('template/footer');
    }

    public function auto() {
        $data = array("keywords"=>null, "item"=>null);
        $keywords = $this->input->get('search');
        if(isset($keywords)){
            $data['item'] = $this->items_model->search($keywords);
        }
        if ($keywords != "") {
            $data['var']= $this->items_model->auto_complete($keywords);
                echo json_encode($data['var']);
        } else {
                $data['var']= null; 
                echo json_encode($data['var']);
        }
    } 
    public function findCountry() {
        $connect = mysqli_connect("localhost", "root", "f50e8c764f26376f", "user");   
        if(isset($_POST["query"]))  
        {  
            $output = '';  
            $query = "SELECT * FROM tbl_country WHERE country_name LIKE '%".$_POST["query"]."%'";  
            $result = mysqli_query($connect, $query);  
            $output = '<ul class="list-unstyled">';  
            if(mysqli_num_rows($result) > 0)  
            {  
                while($row = mysqli_fetch_array($result))  
                {  
                        $output .= '<li>'.$row["country_name"].'</li>';  
                }  
            }  
            else  
            {  
                $output .= '<li>Country Not Found</li>';  
            }  
            $output .= '</ul>';  
            echo $output;  
        }  
    }  
}