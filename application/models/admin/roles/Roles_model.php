<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Roles Model
*/
class Roles_model extends CI_Model{
	var $table = 'roles';
    var $column_order = array(null,null,'name','role_type', null); //set column field database for datatable orderable
    var $column_search = array('name', 'role_type'); 
    var $order = array('name' => 'asc'); // default order 
  	
  	public function __construct(){
	   parent::__construct();
	}

	private function _get_roles_datatables_query(){
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

  	public function get_role_information() {
        $this->_get_roles_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_role() {
        $this->_get_roles_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_role() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function save_role_record($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}

	public function check_role_name($name){
        $this->db->select('name');
        $this->db->from($this->table);
        $this->db->where('name',$name);
        $query = $this->db->get();
        return $query->num_rows();
    }

	public function get_by_role_id($role_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('role_id', $role_id);
        $query = $this->db->get();
        return $query->row();
	}

    public function get_emp_roles(){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('role !=', 2);
        $this->db->where('role !=', 5);
        # check super administrator permission
        if ($this->userdata['role'] == 5) {
          # code...
            $this->db->where('role !=', 1);
            $this->db->where('role !=',$this->userdata['role']);
        }else{
            $this->db->where('role !=', 1);
            $this->db->where('role !=',$this->userdata['role']);
        }
        $this->db->order_by('role_id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

	public function get_roles(){
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->order_by('role_id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function update_role_record($role_id, $data) {
		$this->db->where('role_id', $role_id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
    public function delete_by_role_id($role_id) {
        $this->db->where('role_id', $role_id);
        $this->db->where('role_type','custom');
        $this->db->delete($this->table);
    }

    public function get_maximun_role_id(){
    	$this->db->select_max('role');
    	$this->db->from($this->table);
        $query = $this->db->get();
        $data = $query->row();
        return $data->role;
    }

    public function get_role_name_by_role($role){
        $this->db->select('name');
        $this->db->from($this->table);
        $this->db->where('role', $role);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['name'];
    }

    public function get_role_name_by_role_id(){
        $this->db->select('name');
        $this->db->from($this->table);
        $this->db->where('role_id =',3);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['name'];
    }

}