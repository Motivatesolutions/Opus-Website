<?php
 /**
  * Roles Controoler
  */
class Roles extends Admin_Controller{

 	public function __construct(){
 		parent::__construct();
 		$this->load->model('admin/roles/roles_model','role');
 	}

  	public function index(){
 		$data['title'] = $this->sspname.'Roles';
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # access granted
            $this->render_template('admin/role/roles', $data);
        }else{
            # call access denied function
            $this->render_403_template();
        }
	}

    public function get_roles_info(){
       $data = $this->role->get_emp_roles();
       echo json_encode($data);
    }

  	public function generate_role(){
 		$list = $this->role->get_role_information();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record) {
            $no++;
            $row = array();
		   /*$row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'
		     		.$record->role_id.'">
		        </div>';*/
            $row[] = $no;
            $row[] = $record->name;
            $row[] = $record->role_type;
            //$row[] = url_title($record->name, 'dash', true);
            # check if role type is equal system to hide delete button
            if (strtolower($record->role_type) == 'system') {
                # hide delete button...
                $row[] = '
                <div class="dropdown text-center">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        Actions
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="text-primary" href="javascript:void(0)" onclick="view_role(' . "'" . $record->role_id . "'" . ')"><i class="fa fa-eye"></i> View Role</a></li>
                        <li><a class="text-primary" href="javascript:void(0)" onclick="update_role(' . "'" . $record->role_id . "'" . ')"><i class="fa fa-edit"></i> Edit Role</a></li>
                        <!--<li><a class="text-danger" href="javascript:void(0)" onclick="delete_role(' . "'" . $record->role_id . "'" . ',' . "'" . $record->name . "'" . ')"><i class="fa fa-trash"></i> Delete Role</a></li>-->
                    </ul>
                </div>
            ';
            }else{
                # show delete button...
                $row[] = '
                    <div class="dropdown text-center">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                            Actions
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="text-primary" href="javascript:void(0)" onclick="view_role(' . "'" . $record->role_id . "'" . ')"><i class="fa fa-eye"></i> View Role</a></li>
                            <li><a class="text-primary" href="javascript:void(0)" onclick="update_role(' . "'" . $record->role_id . "'" . ')"><i class="fa fa-edit"></i> Edit Role</a></li>
                            <li><a class="text-danger" href="javascript:void(0)" onclick="delete_role(' . "'" . $record->role_id . "'" . ',' . "'" . $record->name . "'" . ')"><i class="fa fa-trash"></i> Delete Role</a></li>
                        </ul>
                    </div>
                ';
            }
        	$data[] = $row;
	    }
	    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->role->count_all_role(),
            "recordsFiltered" => $this->role->count_filtered_role(),
            "data" => $data,
            );
	    //output to json format
		echo json_encode($output);
	}

    public function get_records_by_role_id($role_id){
        $data = $this->role->get_by_role_id($role_id);
        echo json_encode($data);
	}

 	public function add_new_role(){
        $this->validate_role_records();
        $role_name = $this->input->post('role');
        $max_role = $this->role->get_maximun_role_id();
        $role = $max_role + 1;

        $data = array(
        	'role' =>  $role,
         	'name' => $this->input->post('role'),
         	'role_type' => 'custom'
             );
        //check for existence
        $checkexistName    = $this->role->check_role_name($role_name);
        if ($this->userdata['role'] == 1){
            # check if faculty name already added...
            if($checkexistName > 0){
                echo json_encode("role_name_exists");
            }else{

                $insert = $this->role->save_role_record($data);
                echo json_encode(array("status" => TRUE));
            } 
        }else{
            echo json_encode("access_denied");
        } 
    }

    public function update_role_records(){
        $this->validate_role_records();
        $data = array(
            'name' => $this->input->post('role'),
            );
        $role_id =  $this->input->post('roleid');
        # check user permission
        if ($this->userdata['role'] == 1) {
            $this->role->update_role_record($role_id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

	public function delete_role_record($role_id){
        # check user permission
        if ($this->userdata['role'] == 1) {
            $this->role->delete_by_role_id($role_id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_role_delete(){
        $selectedRoleID = $this->input->post('role_id');
        # check user permission
        if ($this->userdata['role'] == 1) {
            foreach ($selectedRoleID as $role_id) {
                # perform class delete...
                $this->role->delete_by_role_id($role_id);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    private function validate_role_records(){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('role') == '') {
            $data['inputerror'][] = 'role';
            $data['error_string'][] = 'Role Name is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}