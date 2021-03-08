<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Teacher Information Model
 */
class Teacher_model extends CI_Model{
	var $table = "teacher";
	var $column_order  = array(null,null,'name','photo','phone','email','address', null); //set column field database for datatable orderable
    var $column_search = array('name','photo','phone','email','address'); //set column field database for datatable searchable just name , teacher_id , school_name are searchable
    var $order = array('name' => 'asc'); // default order 
	public function __construct(){
		parent::__construct();
	}

	private function _get_datatables_query() {
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

    public function get_teacher_information($condition) {
    	$this->_get_datatables_query();
        $this->db->where($condition);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

     public function count_filtered_teacher($condition) {
        $this->_get_datatables_query();
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_teacher($condition){
        $this->db->from($this->table);
        $this->db->where($condition);
        return $this->db->count_all_results();
    }

    public function check_email_exit($email){
        $this->db->select('email');
        $this->db->from($this->table);
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->num_rows();

    }
    public function check_contact_exit($contact){
        $this->db->select('phone');
        $this->db->from($this->table);
        $this->db->where('phone', $contact);
        $query = $this->db->get();
        return $query->num_rows();

    }

    public function check_teacher_name_exit($name){
        $this->db->select('name');
        $this->db->from($this->table);
        $this->db->where('name', $name);
        $query = $this->db->get();
        return $query->num_rows();

    }
    public function save_teacher_record($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_teacher_id($teacher_id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('id', $teacher_id);
      $query = $this->db->get();
      return $query->row();
    }

    public function update_teacher_record($id, $data) {
      $this->db->where('id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
    }
    
    public function delete_by_teacher_id($teacher_id) {
      $this->db->where('id', $teacher_id);
      $this->db->delete($this->table);
    }

    public function get_teachers_info_by_teacher_id($teacher_id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('id', $teacher_id);
      $query = $this->db->get();
      return $query->row();
    }
    public function get_roles_by_role_name(){
        $column = array('T.*','R.name' );
        $this->db->select($column);
        $this->db->from($this->table, 'AS T');
        $this->db->join('roles R', 'R.id = T.designation ','left');
        $this->db->order_by('T.id', 'asc');
        $query = $this->db->get();
        return $query->num_ows();
    }
}
