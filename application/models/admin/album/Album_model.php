<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    /**
     * album Model
     */
    class album_model extends CI_Model{
     var $table = 'album';
    var $column_order = array(null,null,'album_title','release_year',null); //set column field database for datatable orderable
    var $column_search = array('album_title','release_year','added_date'); //set column field database for datatable searchable just name , staff_name , message are searchable
    var $order = array('album_title' => 'asc'); // default order 

    public function __construct(){
      parent::__construct();
    }

    private function _get_album_datatables_query() {
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

    public function get_album_information() {
      $this->_get_album_datatables_query();
      if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query->result();
    }

    public function get_all_albums(){
      $this->db->select('*');
      $this->db->from($this->table);
      $query = $this->db->get();
      return $query->result();
    }

    public function check_album($album_title){
      $this->db->select('album_title');
      $this->db->from($this->table);
      $this->db->where('album_title',$album_title);
      $query=$this->db->get();
      return $query->num_rows();
    }

    public function count_filtered_album() {
      $this->_get_album_datatables_query();
      $query = $this->db->get();
      return $query->num_rows();
    }

    public function count_all_album(){
      $this->db->from($this->table); 
      return $this->db->count_all_results();
    }

    public function save_album_record($data) {
      $this->db->insert($this->table, $data);
      return $this->db->insert_id();
    }

    public function get_by_id($album_id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('album_id', $album_id);
      $query = $this->db->get();
      return $query->row();
    }

    public function update_album_record($album_id, $data) {
      $this->db->where('album_id', $album_id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
    }

    public function delete_by_id($album_id) {
      $this->db->where('album_id', $album_id);
      $this->db->delete($this->table);
    }

    public function get_albums_info_by_id($album_id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('album_id', $album_id);
      $query = $this->db->get();
      return $query->row();
    }

    public function count_total_albums(){
      $this->db->from($this->table); 
      return $this->db->count_all_results();
    }

    public function get_album_info($max){
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->limit($max);
      $this->db->order_by('album_id', "DESC");
      $query = $this->db->get();
      return $query->result_array();
    }
}