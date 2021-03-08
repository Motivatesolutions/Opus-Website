<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Blogs Model
*/
class Blog_model extends CI_Model{
	var $table = 'blog';
    var $column_order = array(null,null,'blog_title','created_at','created_by','updated_at', null); 
    var $column_search = array('blog_title','created_at'); 
    var $order = array('blog_id' => 'desc'); 
  	
  	public function __construct(){
	   parent::__construct();
	}

	private function _get_blogs_datatables_query(){
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

  	public function get_blogs_information() {
        $this->_get_blogs_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_blogs() {
        $this->_get_blogs_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_blogs() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function save_blog_record($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}

	public function check_blog_name($check){
        $this->db->select('blog_title');
        $this->db->from($this->table);
        $this->db->where($check);
        $query = $this->db->get();
        return $query->num_rows();
    }

	public function get_topics(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('topic_id', 'ASC');
		$query = $this->db->get();
		return $query->result();
    }
    
    public function get_record_by_blog_id($blog_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('blog_id', $blog_id);
        $query = $this->db->get();
        return $query->row();
	}

	public function update_blogs_record($blog_id, $data) {
		$this->db->where('blog_id', $blog_id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete_by_blog_id($blog_id) {
        $this->db->where('blog_id', $blog_id);
        $this->db->delete($this->table);
    }

    public function get_group_blogs_info($max, $condition){
        $this->db->select('blog_id,group_id,topic_id, blog_title,blog_content, blog_file');
        $this->db->from($this->table);
        $this->db->where($condition);
        //$this->db->limit($max);
        $this->db->order_by('blog_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function generate_blog_info($max){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->limit($max);
        $this->db->order_by('blog_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }



    public function get_user_topics(){
        $this->db->select('topic_id, blog_title');
        $this->db->from($this->table);
        $this->db->where('menu_type','topic');
        # check whether student
        if ($this->userdata['role'] == 2) {
            $this->db->where('school_id', $this->userdata['school_id']);
            $this->db->where('class_id', $this->userdata['class_id']);
        }
        $this->db->order_by('topic_id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_user_quiz_topics(){
        $this->db->select('topic_id, blog_title');
        $this->db->from($this->table);
        $this->db->where('menu_type','quiz');
        # check whether student
        if ($this->userdata['role'] == 2) {
            $this->db->where('school_id', $this->userdata['school_id']);
            $this->db->where('class_id', $this->userdata['class_id']);
        }
        $this->db->order_by('topic_id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }





}