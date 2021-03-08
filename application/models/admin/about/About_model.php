<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    /**
     * about Model
     */
    class About_model extends CI_Model{
     var $table = 'about';
    var $column_order = array(null,null,'about','mission','vision','services','more','existence',null); 
    //set column field database for datatable orderable
    var $column_search = array('about','mission','vision','sevices','more','existence'); //set column field database for datatable searchable just name , staff_name , description are searchable
    var $order = array('created_date' => 'asc'); // default order 

    public function __construct(){
      parent::__construct();
    }

    private function _get_about_datatables_query() {
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

    public function get_about_information() {
      $this->_get_about_datatables_query();
      if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query->result();
    }

    public function get_all_abouts(){
      $this->db->select('*');
      $this->db->from($this->table);
      $query = $this->db->get();
      return $query->result();
    }

    public function check_about($about){
      $this->db->select('about');
      $this->db->from($this->table);
      $this->db->where('about',$about);
      $query=$this->db->get();
      return $query->num_rows();
    }

    public function count_filtered_about() {
      $this->_get_about_datatables_query();
      $query = $this->db->get();
      return $query->num_rows();
    }

    public function count_all_about(){
      $this->db->from($this->table); 
      return $this->db->count_all_results();
    }

    public function save_about_record($data) {
      $this->db->insert($this->table, $data);
      return $this->db->insert_id();
    }

    public function get_about_by_id($id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('id', $id);
      $query = $this->db->get();
      return $query->row();
    }

    public function update_about_record($id, $data) {
      $this->db->where('id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
      $this->db->where('id', $id);
      $this->db->delete($this->table);
    }

    public function get_abouts_info_by_id($id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('id', $id);
      $query = $this->db->get();
      return $query->row();
    }

    public function count_total_abouts(){
      $this->db->from($this->table); 
      return $this->db->count_all_results();
    }
    public function get_about(){
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get();
      return $query->result();
    }
}