<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Employee Controoler
*/
class Employees extends Admin_Controller{
	 	
 	function __construct(){
 		parent::__construct();
 		$this->load->model('admin/roles/roles_model','role');
 		$this->load->model('admin/users/users_model','user');
 		$this->load->model('admin/employee/employee_model','employee');
 	}

 	public function index(){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
     		$data['title'] = $this->sspname.'Employee';
            $data['roleResults'] = $this->role->get_emp_roles();
     		$this->render_template('admin/employee/employees', $data);
        }else{
            $this->render_403_template();
        }
 	}

 	public function generate_employee(){
 		$list = $this->employee->get_employee_information();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record){
            $no++;
            $row = array();
            $row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.
            			$record->id.'">
            		</div>';
            $row[] = $no;
            if ($record->photo == "") {
            	$row[] = '<img src="'.base_url('uploads/users/nophoto.jpg').'" style="height:20px; width:20px" class="" onclick="view_photo('."'".$record->id."'".')" />
            	';
            }else{
            	$row[] = '<img src="'.base_url('uploads/employees/'.$record->photo).'" style="height:50px; width:auto" onclick="view_photo('."'".$record->id."'".')" />
            	';
            }
            $row[] = $record->emp_name;
            $row[] = $record->contact;
            $row[] = $record->email;
            $row[] = $record->address;
            $row[] = $record->emp_rname;
            $row[] = '
                <div class="dropdown text-center">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                        data-toggle="dropdown">Actions<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="text-success" href="javascript:void(0)" 
                            onclick="view_employee(' . "'" . $record->id . "'" . ')">
                            <i class="fa fa-eye"></i>View</a>
                        </li>
                        <li><a class="text-primary" href="javascript:void(0)" 
                            onclick="update_employee(' . "'" . $record->id . "'" . ')">
                            <i class="fa fa-edit"></i>Edit</a>
                        </li>
                        <li><a class="text-danger" href="javascript:void(0)" 
                            onclick="delete_employee(' . "'" . $record->id . "'" . ',' . "'" . $record->emp_name . "'" . ')">
                            <i class="fa fa-trash"></i> Delete</a>
                        </li>
                    </ul>
                </div>
            ';
            //add html for action
            $data[] = $row;
	    }
	    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->count_all_employee(),
            "recordsFiltered" => $this->employee->count_filtered_employee(),
            "data" => $data,
            );
        //output to json format
	    echo json_encode($output);
 	}

    public function get_records_by_empoyeee_id($employee_id){
        $data = $this->employee->get_by_employee_id($employee_id);
        echo json_encode($data);
	}

 	public function add_new_employee(){
        $this->validate_employee_records();
        $employee_name = $this->input->post('emp_name');
        $contact    = $this->input->post('contact'); 
        $password   = $this->employee->generate_user_password();
        # role information
        $roleRow = $this->role->get_by_role_id($this->input->post('emp_role'));
        $roleName = $roleRow->name;
        $data = array(
            'emp_role' => $this->input->post('emp_role'),
         	'emp_name'    => $this->input->post('emp_name'),
            'dob'         => $this->input->post('birthday'),
            'gender'      => $this->input->post('gender'),
            'address'     => $this->input->post('address'),
            'email'		  => $this->input->post('email'),
            'facebook_link'    => $this->input->post('facebook_link'),
            'twitter_link'         => $this->input->post('twitter_link'),
            'youtube_link'      => $this->input->post('youtube_link'),
        	'contact'     => trim(preg_replace('/^0/', '+256', $this->input->post('contact'))),
            'nok_name'    => $this->input->post('nok_name'),
            'nok_contact' => trim(preg_replace('/^0/', '+256', $this->input->post('nok_contact'))),
            'nationality' => $this->input->post('nationality'),
            'emp_rname'   => $roleName,
            'reg_date'    => $this->input->post('join_date'),
            'reg_at'      => date('h:i:sa')
        );
        //check for existence
        $checkexistContact = $this->employee->check_employee_contact($contact);
        $checkEmpEmail     = $this->employee->check_email($this->input->post('email'));
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # check if the added employee id already taken...
            if ($checkEmpEmail > 0) {
            	echo json_encode('email_exist');
            }elseif ($checkexistContact > 0){
            	 echo  json_decode("contact_exists");
            }else{
            	# check if the employee photo is being uploaded
            	if (!empty($_FILES['photo']['name'])) {
		            $upload = $this->do_upload_employee_photo();
		            $data['photo'] = $upload;
		        }
                $insert = $this->employee->save_employee_record($data);
                # creating employee accounts automatically
                $newData = array(
                	'role'       => $this->input->post('emp_role'),
                	'email'      =>  $this->input->post('email'),
                	'password'   =>  $password,
                	'status'     =>  'active',
                	'name'       =>  $this->input->post('emp_name'),
                	'phone'      =>  trim(preg_replace('/^0/', '+256', $this->input->post('contact'))),
                	'jdate'      =>  $this->input->post('join_date'),
                	'created_at' =>  date('h:i:sa'),
                	'user_id' => $insert
                	);
                # check if the Employee photo is being uploaded
            	if (!empty($_FILES['photo']['name'])) {
		            move_uploaded_file($_FILES['photo']['tmp_name'], './uploads/users/'.$upload);
		            $newData['photo'] = $upload;
		        }
		        $this->user->save_users($newData);
                # password message to be sent to employee after registration
                $email = $this->input->post('email');
                $message = "Hi ".$this->input->post('emp_name')."!<br><h4>Thank you for registering with Us</h4><br>Here is your Login Account Details:<br><br>Email: ".$email."<br>Password: ".$password."<br>Please you can change your password after loging-in.<br><br>You can login at ".base_url();
                $subject = "New Account Creation";
                $this->employee->send_email($message,$subject,$email);
                echo json_encode(array("status" => TRUE));
            } 
        }else{
            echo json_encode("access_denied");
        } 
    }

	public function update_employee_records(){
        $this->validate_employee_records();
        $roleRow = $this->role->get_by_role_id($this->input->post('emp_role'));
        $roleName = $roleRow->name;
        $data = array(
            'emp_rname'   => $roleName,
            'emp_role' => $this->input->post('emp_role'),
         	'emp_name'    => $this->input->post('emp_name'),
            'dob'         => $this->input->post('birthday'),
            'gender'      => $this->input->post('gender'),
            'address'     => $this->input->post('address'),
            'email'		  => $this->input->post('email'),
            'facebook_link'    => $this->input->post('facebook_link'),
            'twitter_link'         => $this->input->post('twitter_link'),
            'youtube_link'      => $this->input->post('youtube_link'),
        	'contact'     => trim(preg_replace('/^0/', '+256', $this->input->post('contact'))),
            'nok_name'    => $this->input->post('nok_name'),
            'nok_contact' => trim(preg_replace('/^0/', '+256', $this->input->post('nok_contact'))),
            'nationality' => $this->input->post('nationality'),
            'reg_date'    => $this->input->post('join_date'),
            'reg_at'      => date('h:i:sa')
        );
        $id = $this->input->post('employeeid');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
        	if (!empty($_FILES['photo']['name'])) {
	            $upload = $this->do_upload_employee_photo();
	            # Removing the existing employee profile picture
	            $employeeRow = $this->employee->get_by_employee_id($this->input->post('employeeid'));
	            if(file_exists('uploads/employees/'.$employeeRow->photo) && $employeeRow->photo){
	                unlink('uploads/employees/'.$employeeRow->photo);
	            }
	            $data['photo'] = $upload;
            }
            $this->employee->update_employee_record($id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function delete_employee_record($employee_id){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
        	# Removing the existing employee picture
            $employeeRow = $this->employee->get_employees_info_by_employee_id($employee_id);
            if(file_exists('uploads/employees/'.$employeeRow->photo) && $employeeRow->photo){
                unlink('uploads/employees/'.$employeeRow->photo);
            }
            # delete employee information from employee information
            $this->employee->delete_by_employee_id($employee_id);
            # delete employee information from transaction table
            $this->users_model->delete_emp_by_employee_id($employee_id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_employee_delete(){
        $selectedEmplooyeeID = $this->input->post('emp_id');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
            foreach ($selectedEmplooyeeID as $empid) {
            	# Removing the existing employee picture
	            $employeeRow = $this->employee->get_employees_info_by_employee_id($empid);
	            if(file_exists('uploads/employees/'.$employeeRow->photo) && $employeeRow->photo){
	                unlink('uploads/employees/'.$employeeRow->photo);
	            }
                # delete employee information from employee table
                $this->employee->delete_by_employee_id($empid);
                # delete employee information from transaction table
                $this->users_model->delete_emp_by_employee_id($empid);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    private function do_upload_employee_photo() {
    	$employeeName = $this->input->post('emp_name');
        $config['upload_path'] = './uploads/employees/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']             = 8400; //set max size allowed in Kilobyte
        $config['max_width']            = 600; // set max width image allowed
        $config['max_height']           = 600; // set max height allowed
        //$config['file_name'] = round(microtime(true) * 1000);
        $config['file_name'] = $employeeName; 
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('photo')) { //upload and validate
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload Error: ' . $this->upload->display_errors('', ''); 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

 	private function validate_employee_records(){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('email') == ''){
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Employee Email is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('emp_name') == ''){
            $data['inputerror'][] = 'emp_name';
            $data['error_string'][] = 'Employee name is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('emp_role') == ''){
            $data['inputerror'][] = 'emp_role';
            $data['error_string'][] = 'Employee Role is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('birthday') == ''){
            $data['inputerror'][] = 'birthday';
            $data['error_string'][] = 'Birthday is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('gender') == ''){
            $data['inputerror'][] = 'gender';
            $data['error_string'][] = 'Gender is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('address') == ''){
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('contact') == ''){
            $data['inputerror'][] = 'contact';
            $data['error_string'][] = 'Phone number is required';
            $data['status'] = FALSE;
        }
        
        if ($this->input->post('nationality') == ''){
            $data['inputerror'][] = 'nationality';
            $data['error_string'][] = 'Nationality is required';
            $data['status'] = FALSE;
        }
         if ($this->input->post('nok_name') == ''){
            $data['inputerror'][] = 'nok_name';
            $data['error_string'][] = 'Next of kin Name is required';
            $data['status'] = FALSE;
        }
         if ($this->input->post('nok_contact') == ''){
            $data['inputerror'][] = 'nok_contact';
            $data['error_string'][] = 'Next of kin Contact is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('join_date') == ''){
            $data['inputerror'][] = 'join_date';
            $data['error_string'][] = 'Join date is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}