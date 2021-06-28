<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class User_model extends CI_Model{

    public function __construct() {
		$this->load->database();
		$this->userTable = 'users';
    }
    // Log in
    public function login($email, $password){
        // Validate
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $result = $this->db->get('users');

        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }
    }
    /********************register******************* */
    public function is_exist($email) {
		$this->db->select('*');
		$this->db->from($this->userTable);
		$this->db->where('email', $email);
		$query  = $this->db->get();
		$row = $query->row_array();
		if (isset($row)) {
            return TRUE;	
        } 
        return FALSE;
    }
    public function get_user_info($email) {
		$this->db->select('*');
		$this->db->from($this->userTable);
		$this->db->where('email', $email);
		$query  = $this->db->get();
		return $query->row_array();
	}
    public function create_account($email, $password, $username, $code) {
		$data = array(
			'email' => $email,
            'password' => $password,
            'username' => $username,
            'verify_code' => $code,
            'status' => 0
		);
		$this->db->insert(
			$this->userTable,
			$data
		);
    }
    public function is_active($email){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$email);
        $row = $this->db->get();

        if($row['status'] == 1){
            return true;
        }else{
             return false;
        }
    }
    public function active($code) {
		$data = array('status' => 1);
        $this->db->where('verify_code', $code);
        $this->db->update($this->userTable, $data);
	}
    /*********************************Profile******************************/
    public function update_username($email,$name){
        $query=$this->db->query("UPDATE users SET username='$name' WHERE email ='$email'");

    }
    public function update_location($email,$location){
        $query=$this->db->query("UPDATE users SET region='$location' WHERE email ='$email'");
    }

    /*******************************forget password*************************/
    public function send_tokens($email, $token) {
        $query = $this->db->query("UPDATE users SET reset_code='$token' WHERE email ='$email'");
	}

    public function compare($new_pass,$repeat_pass){
        if($new_pass != $repeat_pass){
            return false;
        }else{
            return true;
        }
    }
    public function update_password($email, $token, $password) {
        $query = $this->db->query("SELECT * FROM users WHERE email='" . $email . "'");
		$row = $query->row_array();
        if (!isset($row)) {
            return FALSE;	
        } 
        if($token != $row['reset_code']){
            return FALSE;
        }
        $query = $this->db->query("UPDATE users SET password = '$password' WHERE email='$email'");
        return TRUE;
	}
}
?>
