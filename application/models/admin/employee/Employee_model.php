<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    /**
     * Employee Model
     */
    class Employee_model extends CI_Model{
     var $table = 'employees';
    var $column_order = array(null,null,'emp_name', 'email','address','contact','emp_rname',null, null); //set column field database for datatable orderable
    var $column_search = array('emp_name', 'email','address','contact','emp_rname'); //set column field database for datatable searchable just name , staff_name , address are searchable
    var $order = array('emp_name' => 'asc'); // default order 

    public function __construct(){
      parent::__construct();
    }

    private function _get_employee_datatables_query() {
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

    public function get_employee_information() {
      $this->_get_employee_datatables_query();
      if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query->result();
    }

    /*public function get_employees(){
      $column = array('E.*','B.branch_name');
      $this->db->select($column);
      $this->db->from('employees AS E');
      $this->db->join('roles AS R','R.role_id = E.branch_id','left');
      $this->db->order_by('E.id','ASC');
      $query =  $this->db->get();
      return $query->result();
    }*/

    public function get_all_employees(){
      $this->db->select('*');
      $this->db->from($this->table);
      $query = $this->db->get();
      return $query->result();
    }

    public function check_employee_id($employee_id){
      $this->db->select('emp_id');
      $this->db->from($this->table);
      $this->db->where('emp_id',$employee_id);
      $query = $this->db->get();
      return $query->num_rows();
    }
    public function check_employee_contact($contact){
      $this->db->select('contact');
      $this->db->from($this->table);
      $this->db->where('contact',$contact);
      $query=$this->db->get();
      return $query->num_rows();
    }
    public function check_employee_name($emp_name){
      $this->db->select('emp_name');
      $this->db->from($this->table);
      $this->db->where('emp_name',$emp_name);
      $query=$this->db->get();
      return $query->num_rows();
    }
    public function check_username($username){
      $this->db->select('username');
      $this->db->from($this->table);
      $this->db->where('username',$username);
      $query=$this->db->get();
      return $query->num_rows();
    }
    public function check_email($email){
      $this->db->select('email');
      $this->db->from($this->table);
      $this->db->where('email',$email);
      $query=$this->db->get();
      return $query->num_rows();
    }

    public function count_filtered_employee() {
      $this->_get_employee_datatables_query();
      $query = $this->db->get();
      return $query->num_rows();
    }

    public function count_all_employee(){
      $this->db->from($this->table); 
      return $this->db->count_all_results();
    }

    public function save_employee_record($data) {
      $this->db->insert($this->table, $data);
      return $this->db->insert_id();
    }

    public function get_by_employee_id($employee_id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('id', $employee_id);
      $query = $this->db->get();
      return $query->row();
    }

    public function update_employee_record($id, $data) {
      $this->db->where('id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
    }

    public function delete_by_employee_id($emp_id) {
      $this->db->where('id', $emp_id);
      $this->db->delete($this->table);
    }

    public function get_employees_info_by_employee_id($employee_id) {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('id', $employee_id);
      $query = $this->db->get();
      return $query->row();
    }

    public function count_total_employees(){
      $this->db->from($this->table); 
      return $this->db->count_all_results();
    }

    public function get_emp_result(){
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('emp_role =', 4);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();
      return $query->result();
    }

    public function get_presenters_info($max){
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->limit($max);
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_team(){
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get();
      return $query->result();
    }

    public function generate_user_password(){
      $chars = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ023456789!@#$%^&*()_=";
      $password = substr(str_shuffle($chars ),0,10 );
      return $password;
    }

    public function send_email($message,$subject,$sendTo){
      require_once APPPATH.'libraries/mailer/class.phpmailer.php';
      require_once APPPATH.'libraries/mailer/class.smtp.php';
      require_once APPPATH.'libraries/mailer/mailer_config.php';
      include APPPATH.'libraries/mailer/template/template.php';
      
      $mail = new PHPMailer(true);
      $mail->IsSMTP();
      try
      {
          $mail->SMTPDebug = 1;  
          $mail->SMTPAuth = true; 
          $mail->SMTPSecure = 'ssl'; 
          $mail->Host = HOST;
          $mail->Port = PORT;  
          $mail->Username = GUSER;  
          $mail->Password = GPWD;     
          $mail->SetFrom(GUSER, 'Administrator');
          $mail->Subject = $subject;
          $mail->IsHTML(true);   
          $mail->WordWrap = 0;

          $hello='<center><img src=https://www.saipali.education/new/wp-content/uploads/2019/06/saipali-logo_new.png></center><br>';
          $thanks = "<br><br><i>This is autogenerated email please do not reply.</i><br/><br/>Thanks,<br/>Admin ".ucwords(strtolower($this->systemdata->sname))."<br/><br/>";

          $body = $hello.$message.$thanks;
          $mail->Body = $header.$body.$footer;
          $mail->AddAddress($sendTo);

          if(!$mail->Send()) {
              $error = 'Mail error: '.$mail->ErrorInfo;
              return array('status' => false, 'message' => $error);
          } else { 
              return array('status' => true, 'message' => '');
          }
      }
      catch (phpmailerException $e)
      {
          $error = 'Mail error: '.$e->errorMessage();
          return array('status' => false, 'message' => $error);
      }
      catch (Exception $e)
      {
          $error = 'Mail error: '.$e->getMessage();
          return array('status' => false, 'message' => $error);
      }
      
  }
}