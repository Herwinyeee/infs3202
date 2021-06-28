<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Items_model extends CI_Model{

    public function __construct() {
		$this->load->database();
        $this->userTable = 'users';
        $this->itemTable = 'items';
        $this->ratingTable = 'rating';
        $this->cartTable = 'cart';

	}
    public function post_item($itemId, $itemName, $price, 
            $description, $image, $status) {
        $sellerEmail = $_SESSION['email'];
        $data = array(
            'itemId' => $itemId,
            'itemName' => $itemName,
            'image' => $image,
            'price' => $price,
            'sellerEmail' => $sellerEmail,
            'description' => $description,
            'status' => $status
        );
        $this->db->insert(
			$this->itemTable,
			$data
        );
        return $itemId;
    }
    /****************************Item*************************/
    public function load($itemid){
        $query = $this->db->query("SELECT * FROM  items WHERE itemid = '$itemid'");
        $row = $query->row_array();
        return $row;
    }
    public function get_price($itemid){
        $query = $this->db->query("SELECT * FROM items WHERE itemid = '$itemid'");
        $row = $query->row_array();
        return $row['price'];
    }
    public function get_name($itemid){
        $query = $this->db->query("SELECT * FROM items WHERE itemid = '$itemid'");
        $row = $query->row_array();
        return $row['itemname'];
    }
    public function get_des($itemid){
        $query = $this->db->query("SELECT * FROM items WHERE itemid = '$itemid'");
        $row = $query->row_array();
        return $row['description'];
    }
    public function add_comment($ratingId, $itemId, $rating, $comment) {
        $data = array(
            'ratingid' => $ratingId,
			'itemid' => $itemId,
			'rating' => $rating,
			'comment' => $comment
		);
		$this->db->insert(
			$this->ratingTable,
			$data
		);
    }
    public function get_ave_rating($itemId){
        $this->db->select("rating");
		$this->db->from($this->ratingTable);
		$this->db->where("itemid", $itemId);
        $query  = $this->db->get();
        $number = 0;
        $count = 0;
        foreach ($query->result() as $row)
        {
            $number = $number + 1;
            $count = $count + $row->rating;
        }
        if ($number == 0) {
            return "Nah";
        } else {
            $answer = $count / $number;
            return $answer;
        }
    }
    public function show_comment($itemId) {
        $this->db->select("comment");
		$this->db->from($this->ratingTable);
		$this->db->where("itemid", $itemId);
        $query  = $this->db->get();
        $comment = "";
        foreach ($query->result() as $row)
        {
            $comment = $row->comment;
        }
        if ($comment == "") {
            return "No comment";
        } else {
            return $comment;
        }
    }

    /**************Search************/
    public function search($keywords) {
		$this->db->select('*');
		$this->db->from($this->itemTable);
		$this->db->like("itemName", $keywords);
        $query  = $this->db->get();
		return $query->result();
	}
    /**********************cart**************/

    public function add_cart($itemId, $email, $cartId) {
        $this->db->select('*');
        $this->db->from($this->cartTable);
        $this -> db -> where('itemid', $itemId);
        $this -> db -> where('email', $email);
        $query  = $this->db->get();
        $row = $query->row_array();
        if (isset($row)) {
            return;
        } else {
            $data = array(
            'email' => $email,
            'itemid' => $itemId,
            'cartid' => $cartId
            );
            $this->db->insert(
                $this->cartTable,
                $data
            );
        }
        
    }

    public function show_cart($email) {
        $this->db->select('*');
        $this->db->from($this->cartTable);
        $this->db->join('items', 'items.itemid = cart.itemid');
        $this->db->where("email", $email);
        $query  = $this->db->get();
        return $query->result();
    }

    public function remove($itemId, $email) {
        $this -> db -> where('itemid', $itemId);
        $this -> db -> where('email', $email);
        $this -> db -> delete('cart');
    }
 }