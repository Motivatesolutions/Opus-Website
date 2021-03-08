<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function check_admin_login($email, $password){
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where("DECODE(password,'sitmPKEY')", $password);
        $query = $this->db->get();
        return $query->result();
    }

    function check_customer_login($customer_id, $password){
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('customer_id', $customer_id);
        $this->db->where("DECODE(password,'sitmPKEY')", $password);
        $query = $this->db->get();
        return $query->result();
    }

    function get_role_name($role){
        $this->db->select("*");
        $this->db->from("roles");
        $this->db->where("role", $role);
        $query = $this->db->get();
        return $query->result();
    }

}