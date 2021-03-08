<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * genre Model
 */
class Genre_model extends CI_Model{
    var $table = 'genre';
	var $column_order  = array(null,null,'genre_name', null); //set column field database for datatable orderable
    var $column_search = array('genre_name'); //set column field database for datatable searchable just name , genre_name , address are searchable
    var $order = array('genre_name' => 'asc'); // default order 

    function __construct(){
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

    public function get_genre_information() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_genre() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_genre(){
	    $this->db->from($this->table); 
	    return $this->db->count_all_results();
    }

    public function get_genres(){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('genre_id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_genre_by_id($genre_id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('genre_id',$genre_id);
        $query = $this->db->get();
        return $query->row(); 
    }

    public function check_genre_name($genre_name){
    	$this->db->select('genre_name');
    	$this->db->from($this->table);
    	$this->db->where('genre_name',$genre_name);
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    // public function get_genre_name_by_id($genre_id){
    //     $this->db->select('genre_name');
    //     $this->db->from($this->table);
    //     $this->db->where('genre_id',$genre_id);
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }

	public function save_genre_record($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update_genre_record($genre_id, $data) {
		$this->db->where('genre_id', $genre_id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete_by_genre_id($genre_id) {
	    $this->db->where('genre_id', $genre_id);
        $this->db->delete($this->table);
    }

}