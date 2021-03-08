<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Subscriber Model
*/
class Subscriber_model extends CI_Model{
	var $table = 'subscriber';
    var $column_order = array(null,null,'email','subscribe_date','status', null); 
    var $column_search = array('email','subscribe_date','status'); 
    var $order = array('email' => 'asc'); 
  	
  	public function __construct(){
	   parent::__construct();
       $this->load->database();
	}

	private function _get_subscribers_datatables_query(){
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search

                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

  	public function get_subscriber_information() {
        $this->_get_subscribers_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_subscriber() {
        $this->_get_subscribers_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_subscriber() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function save_subscriber_record($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}

	public function check_subscriber_email($check){
        $this->db->select('email');
        $this->db->from($this->table);
        $this->db->where('email',$check);
        $query = $this->db->get();
        return $query->num_rows();
    }

	public function get_subscribe_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
	}

	public function update_subscriber_record($id, $data) {
		$this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete_email_by_id($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function get_user_subscriber(){
        $this->db->select('id, email');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}