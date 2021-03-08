<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * artist Information Model
 */
class Artist_model extends CI_Model{
    var $table = 'artists';
	var $column_order  = array(null,null,'artist_name','address','email','contact', null); //set column field database for datatable orderable
    var $column_search = array('artist_name','address','email','contact'); //set column field database for datatable searchable just email , artist_name , address are searchable
    var $order = array('artist_name' => 'asc'); // default order 

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

    public function get_artist_information($condition) {
        $this->_get_datatables_query();
        $this->db->where($condition);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_artist($condition) {
        $this->_get_datatables_query();
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_artist($condition){
	    $this->db->from($this->table); 
        $this->db->where($condition);
	    return $this->db->count_all_results();
    }

    public function get_all_artist(){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('artist_id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_info_by_artist_id($artist_id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('artist_id',$artist_id);
        $query = $this->db->get();
        return $query->row(); 
    }

    public function check_artist_name($artist_name){
    	$this->db->select('artist_name');
    	$this->db->from($this->table);
    	$this->db->where('artist_name',$artist_name);
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    public function generate_artist_reg_no(){
        $num = "1234567890";
        $artist_reg_no = substr(str_shuffle($num),0,7);
        return $artist_reg_no;
    }

	public function save_artist_record($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

     public function get_by_artist_id($artist_id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('artist_id', $artist_id);
      $query = $this->db->get();
      return $query->row();
    }
    
    public function update_artist_record($artist_id, $data) {
		$this->db->where('artist_id', $artist_id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete_by_artist_id($artist_id) {
	    $this->db->where('artist_id', $artist_id);
        $this->db->delete($this->table);
    }

    public function get_artist_name_by_artist_id($artist_id){
        $this->db->select('artist_name');
        $this->db->from($this->table);
        $this->db->where('artist_name',$artist_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_artist_info_by_artist_id($artist_id){
        $column = array('G.genre_id','G.genre_name','Art.artist_name','Art.reg_no');
        $this->db->select($column);
        $this->db->from($this->table.' AS Art');
        $this->db->join('genre G', 'G.genre_id = Art.genre_id','left');
        $this->db->where('Art.artist_id', $artist_id);
        $query = $this->db->get();
        return $query->row_array(); 
    }
    public function get_artist_by_id($artist_id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('artist_id',$artist_id);
        $query = $this->db->get();
        return $query->row(); 
    }

    public function get_artist_info($max){
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->limit($max);
      $this->db->order_by('artist_id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_artist(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('artist_id', 'ASC');
		$query = $this->db->get();
		return $query->result();
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