<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * track Information Model
 */
class Track_model extends CI_Model{
	var $table = "tracks";
	var $column_order  = array(null,null,'track_title','release_year', null); //set column field database for datatable orderable
    var $column_search = array('track_title','release_year'); //set column field database for datatable searchable just name , track_id , school_name are searchable
    var $order = array('release_year' => 'asc'); // default order 
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

    public function get_track_information($condition) {
    	$this->_get_datatables_query();
        $this->db->where($condition);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

     public function count_filtered_track($condition) {
        $this->_get_datatables_query();
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_track($condition){
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

    public function check_track_track_title_exit($track_title){
        $this->db->select('track_title');
        $this->db->from($this->table);
        $this->db->where('track_title', $track_title);
        $query = $this->db->get();
        return $query->num_rows();

    }
    public function save_track_record($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_track_id($track_id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('track_id', $track_id);
      $query = $this->db->get();
      return $query->row();
    }

    public function update_track_record($id, $data) {
      $this->db->where('track_id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
    }
    
    public function delete_by_track_id($track_id) {
      $this->db->where('track_id', $track_id);
      $this->db->delete($this->table);
    }

    public function get_tracks_info_by_track_id($track_id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('track_id', $track_id);
      $query = $this->db->get();
      return $query->row();
    }
    public function get_artist_by_artist_track_title(){
        $column = array('T.*','Art.track_title' );
        $this->db->select($column);
        $this->db->from($this->table, 'AS T');
        $this->db->join('roles Art', 'Art.artist_id = T.artist_id ','left');
        $this->db->order_by('T.track_id', 'asc');
        $query = $this->db->get();
        return $query->num_ows();
    }

    public function get_track_by_artist($artist_id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('artist_id',$artist_id);
        $query = $this->db->get();
         return $query->row();
    }

    public function get_track(){
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }
}
