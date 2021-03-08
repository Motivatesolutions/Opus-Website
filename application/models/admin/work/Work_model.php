<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    /**
     * work Model
     */
    class Work_model extends CI_Model{
     var $table = 'works';
    var $column_order = array(null,null,'title','description','added_date',null); //set column field database for datatable orderable
    var $column_search = array('title','description','added_date'); //set column field database for datatable searchable just name , staff_name , description are searchable
    var $order = array('added_date' => 'asc'); // default order 

    public function __construct(){
      parent::__construct();
    }

    private function _get_work_datatables_query() {
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

    public function get_work_information() {
      $this->_get_work_datatables_query();
      if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query->result();
    }

    public function get_all_works(){
      $this->db->select('*');
      $this->db->from($this->table);
      $query = $this->db->get();
      return $query->result();
    }

    public function check_work($title){
      $this->db->select('title');
      $this->db->from($this->table);
      $this->db->where('title',$title);
      $query=$this->db->get();
      return $query->num_rows();
    }

    public function count_filtered_work() {
      $this->_get_work_datatables_query();
      $query = $this->db->get();
      return $query->num_rows();
    }

    public function count_all_work(){
      $this->db->from($this->table); 
      return $this->db->count_all_results();
    }

    public function save_work_record($data) {
      $this->db->insert($this->table, $data);
      return $this->db->insert_id();
    }

    public function get_by_id($id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('id', $id);
      $query = $this->db->get();
      return $query->row();
    }

    public function update_work_record($id, $data) {
      $this->db->where('id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
      $this->db->where('id', $id);
      $this->db->delete($this->table);
    }

    public function get_works_info_by_id($id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('id', $id);
      $query = $this->db->get();
      return $query->row();
    }

    public function count_total_works(){
      $this->db->from($this->table); 
      return $this->db->count_all_results();
    }
    
    public function get_work_info($max){
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->limit($max);
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
    public function get_workes(){
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get();
      return $query->result();
    }

     /* 
     * Fetch records from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function getRows($params = array()){ 
      $this->db->select('*'); 
      $this->db->from($this->table); 
       
      if(array_key_exists("where", $params)){ 
          foreach($params['where'] as $key => $val){ 
              $this->db->where($key, $val); 
          } 
      } 
       
      if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
          $result = $this->db->count_all_results(); 
      }else{ 
          if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
              if(!empty($params['id'])){ 
                  $this->db->where('id', $params['id']); 
              } 
              $query = $this->db->get(); 
              $result = $query->row_array(); 
          }else{ 
              $this->db->order_by('id', 'desc'); 
              if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                  $this->db->limit($params['limit'],$params['start']); 
              }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                  $this->db->limit($params['limit']); 
              } 
               
              $query = $this->db->get(); 
              $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
          } 
      } 
       
      // Return fetched data 
      return $result; 
  } 

  public function get_work(){
    $this->db->select('*');
    $this->db->from($this->table);
    $query = $this->db->get();
    return $query->first_row();
  }

  public function get_next(){
    $this->db->select('*');
    $this->db->from($this->table);
    $query = $this->db->get();
    return $query->next_row();
  }

  public function get_next3(){
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('id =',3);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_next4(){
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('id =',4);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_next5(){
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('id =',5);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_last_work(){
    $this->db->select('*');
    $this->db->from($this->table);
    $query = $this->db->get();
    return $query->last_row();
  }



  function get_works($limit, $offset) {
		
    if ($offset > 0) {
        $offset = ($offset - 1) * $limit;
    }

    $result['rows'] = $this->db->get($this->table, $limit, $offset);
    $result['num_rows'] = $this->db->count_all_results($this->table);

    return $result;
}
}