<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Users Controller
 */
class Users extends Admin_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/roles/roles_model','role');
		$this->load->model('admin/users/users_model','user');
	}

	public function index(){
		$data['roles'] = $this->user->get_user_roles();
		$data['title'] = $this->sspname.'Users Information';
		# check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # access granted
            $this->render_template('admin/users/users', $data);
        }else{
            # call access denied function
            $this->render_403_template();
        }
	}

	public function generate_user(){
		$list = $this->user->get_all_users();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $record) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.
			$record->id.'">
			</div>';
			$row[] = $no;
			$row[] = $record->name;
			$row[] = $record->rolename;
			$row[] = $record->status;
			$row[] = $record->phone;
			if ($record->photo == "") {
				$row[] = '<img src="'.base_url('uploads/users/nophoto.jpg').'" style="height:50px; width:50px" class="" onclick="view_photo('."'".$record->id."'".')" />
				';
			}else{
				$row[] = '<img src="'.base_url('uploads/users/'.$record->photo).'" style="height:50px; width:auto" onclick="view_photo('."'".$record->id."'".')" />
				';
			}

			$row[] = '
				<div class="dropdown text-center">
					<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
						Actions
					<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a class="text-success" href="javascript:void(0)" onclick="view_user(' . "'" . $record->id . "'" . ')"><i class="fa fa-eye"></i> View User</a></li>
						<li><a class="text-primary" href="javascript:void(0)" onclick="update_user(' . "'" . $record->id . "'" . ')"><i class="fa fa-edit"></i> Edit User</a></li>
						<li><a class="text-danger" href="javascript:void(0)" onclick="delete_user(' . "'" . $record->id . "'" . ',' . "'" . $record->name . "'" . ')"><i class="fa fa-trash"></i> Delete User</a></li>
						<!--<li class="divider"></li>
						<li><a class="text-secondary" href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Send Password Via SMS" onclick="view_password(' . "'" . $record->id . "'" . ')"><i class="fa fa-lock"></i> Send Password</a></li>-->
					</ul>
				</div>
			';
            //add html for action
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->user->count_all_users(),
			"recordsFiltered" => $this->user->count_filtered_users(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function get_records_user_by_id($user_id){
		$data = $this->user->get_user_by_id($user_id);
		echo json_encode($data);
	}

	public function update_user_records_by_id(){
		$this->validate_user_records();
		$data = array(
			'role' => $this->input->post('role'),
			'name' => $this->input->post('user_name'),
			'phone' => trim(preg_replace('/^0/', '+256', $this->input->post('uphone'))),
			'user_id' => $this->input->post('user_id'),
			'status' => $this->input->post('status')
		);
		$id = $this->input->post('uid');
        # check user permission
		if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
			if (!empty($_FILES['photo']['name'])) {
				$upload = $this->upload_user_photo();
	            # Removing the existing user profile picture
				$userRow = $this->user->get_user_by_id($this->input->post('uid'));
				if(file_exists('uploads/users/'.$userRow->photo) && $userRow->photo){
					unlink('uploads/users/'.$userRow->photo);
				}
				$data['photo'] = $upload;
			}
			$this->user->update_status($id, $data);
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode("access_denied");
		}
	}


	public function delete_user_record($user_id){
        # check user permission
		if ($this->userdata['role'] == 5) {
        	# get user information
			$userRow = $this->user->get_user_by_id($user_id);
			if ($userRow->role == 1) {
				echo json_encode("admin_role");
			}else{
            	# delete other users
				if(file_exists('uploads/users/'.$userRow->photo) && $userRow->photo){
					unlink('uploads/users/'.$userRow->photo);
				}
				$this->user->delete_by_user_id($user_id);
				echo json_encode(array("status" => TRUE));
			}

		}else{
			echo json_encode("access_denied");
		}
	}

	public function bulk_user_delete(){
		$selectedUserID = $this->input->post('id');
        # check user permission
		if ($this->userdata['role'] == 5) {
			foreach ($selectedUserID as $id) {
            	# delete user photo
				$userRow = $this->user->get_user_by_id($id);
				if(file_exists('uploads/users/'.$userRow->photo) && $userRow->photo){
					unlink('uploads/users/'.$userRow->photo);
				}
                # perform user delete...
				$this->user->delete_by_user_id($id);
			}
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode("access_denied");
		}
	}

	private function upload_user_photo() {
		$userName = $this->input->post('user_name');
		$config['upload_path'] = './uploads/users/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
        //$config['max_size']             = 8400; //set max size allowed in Kilobyte
        //$config['max_width']            = 290; // set max width image allowed
        //$config['max_height']           = 280; // set max height allowed
        //$config['file_name'] = round(microtime(true) * 1000);
		$config['file_name'] = $userName; 
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

    private function validate_user_records(){
    	$data = array();
    	$data['error_string'] = array();
    	$data['inputerror'] = array();
    	$data['status'] = TRUE;
    	if ($this->input->post('status') == ''){
    		$data['inputerror'][] = 'status';
    		$data['error_string'][] = 'Status is required';
    		$data['status'] = FALSE;
    	}
    	if ($this->input->post('user_name') == ''){
    		$data['inputerror'][] = 'user_name';
    		$data['error_string'][] = 'Name is required';
    		$data['status'] = FALSE;
    	}
    	if ($this->input->post('role') == ''){
    		$data['inputerror'][] = 'role';
    		$data['error_string'][] = 'User Role is required';
    		$data['status'] = FALSE;
    	}
    	if ($this->input->post('uphone') == ''){
    		$data['inputerror'][] = 'uphone';
    		$data['error_string'][] = 'Contact Number is required';
    		$data['status'] = FALSE;
    	}

    	if ($data['status'] === FALSE){
    		echo json_encode($data);
    		exit();
    	}
    }

    public function send_password_via_sms(){
		$username = $this->input->post('vname');
		$memberid = $this->input->post('vuser_id');
		$password = $this->input->post('vpassword');
		# message to be sent to member after registration
		$msg = "New Account Creation!\nHere is your Login Account Details:\nMember ID : ".
		$this->input->post('vuser_id')."\nPassword : ".$password."\nYou can login at  ".base_url();
		# send SMS
		$recipients = trim(preg_replace('/^0/', '+256', $this->input->post('vphone')));
		$results = $this->gateway->sendMessage($recipients, $msg);
		if ($results == TRUE) {
			# message sent...
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode("not_sent");
		}
	}

}