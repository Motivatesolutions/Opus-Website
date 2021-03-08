<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* work Controoler
*/
class Work extends Admin_Controller{
	 	
 	function __construct(){
 		parent::__construct();
 		$this->load->model('admin/roles/roles_model','role');
 		$this->load->model('admin/users/users_model','user');
        $this->load->model('admin/work/work_model','work'); 
 	}

 	public function index(){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
     		$data['title'] = $this->sspname.'work';
            $data['roleResults'] = $this->role->get_emp_roles();
     		$this->render_template('admin/work/index', $data);
        }else{
            $this->render_403_template();
        }
 	}

 	public function generate_work(){
 		$list = $this->work->get_work_information();
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
            	$row[] = '<img src="'.base_url('uploads/work/'.$record->photo).'" style="height:50px; width:auto" onclick="view_photo('."'".$record->id."'".')" />
            	';
            }
            $row[] = $record->title;
            $row[] = $record->description;
            $row[] = $record->added_date;
            $row[] = '
                <div class="dropdown text-center">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                        data-toggle="dropdown">Actions<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="text-success" href="javascript:void(0)" 
                            onclick="view_work(' . "'" . $record->id . "'" . ')">
                            <i class="fa fa-eye"></i>View</a>
                        </li>
                        <li><a class="text-primary" href="javascript:void(0)" 
                            onclick="update_work(' . "'" . $record->id . "'" . ')">
                            <i class="fa fa-edit"></i>Edit</a>
                        </li>
                        <li><a class="text-danger" href="javascript:void(0)" 
                            onclick="delete_work(' . "'" . $record->id . "'" . ',' . "'" . $record->title . "'" . ')">
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
            "recordsTotal" => $this->work->count_all_work(),
            "recordsFiltered" => $this->work->count_filtered_work(),
            "data" => $data,
            );
        //output to json format
	    echo json_encode($output);
 	}

    public function get_records_by_prog_id($id){
        $data = $this->work->get_by_id($id);
        echo json_encode($data);
	}

 	public function add_new_work(){
        $this->validate_work_records();
        $title = $this->input->post('title');
        $data = array(
             'title'    => $this->input->post('title'),
            'description'         => $this->input->post('description'),
            'added_date'    => $this->input->post('added_date')
        );
        //check for existence
        $checkexisttitle = $this->work->check_work($title);
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # check if the added work id already taken...
            if($checkexisttitle > 0){
            	echo  json_decode("work_exists");
            }else{
            	# check if the work photo is being uploaded
            	if (!empty($_FILES['photo']['name'])) {
		            $upload = $this->do_upload_work_photo();
		            $data['photo'] = $upload;
                }
                
                $insert = $this->work->save_work_record($data);
                # creating employee accounts automatically
                $newData = array(
                	'title'       => $this->input->post('title'),
                	'description'      =>  $this->input->post('description'),
                	'added_date'       =>  $this->input->post('added_date')
                	);
                # check if the Employee photo is being uploaded
            	if (!empty($_FILES['photo']['name'])) {
		            move_uploaded_file($_FILES['photo']['tmp_name'], './uploads/countdown/'.$upload);
		            $newData['photo'] = $upload;
		        }
		        $this->countdown->save_countdown_record($newData);
                echo json_encode(array("status" => TRUE));
            } 
        }else{
            echo json_encode("access_denied");
        } 
    }

	public function update_work_records(){
        $data = array(
            'title'    => $this->input->post('title'),
            'description'         => $this->input->post('description'),
            'added_date'    => $this->input->post('added_date')
        );
        $id = $this->input->post('workid');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
        	if (!empty($_FILES['photo']['name'])) {
	            $upload = $this->do_upload_work_photo();
	            # Removing the existing work profile picture
	            $workRow = $this->work->get_by_id($this->input->post('workid'));
	            if(file_exists('uploads/work/'.$workRow->photo) && $workRow->photo){
	                unlink('uploads/work/'.$workRow->photo);
	            }
	            $data['photo'] = $upload;
            }
            $this->work->update_work_record($id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function delete_work_record($id){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
        	# Removing the existing work picture
            $workRow = $this->work->get_work_info_by_id($id);
            if(file_exists('uploads/work/'.$workRow->photo) && $workRow->photo){
                unlink('uploads/work/'.$workRow->photo);
            }
            # delete work information from work information
            $this->work->delete_by_id($id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_work_delete(){
        $selectedworkID = $this->input->post('id');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            foreach ($selectedworkID as $pid) {
            	# Removing the existing work picture
	            $workRow = $this->work->get_work_info_by_id($pid);
	            if(file_exists('uploads/work/'.$workRow->photo) && $workRow->photo){
	                unlink('uploads/work/'.$workRow->photo);
	            }
                # delete work information from work table
                $this->work->delete_by_id($pid);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    private function do_upload_work_photo() {
    	$workName = $this->input->post('title');
        $config['upload_path'] = './uploads/work/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']             = 8400; //set max size allowed in Kilobyte
        $config['max_width']            = 800; // set max width image allowed
        $config['max_height']           = 600; // set max height allowed
        //$config['filtitle'] = round(microtime(true) * 1000);
        $config['filtitle'] = $workName; 
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('photo')) { //upload and validate
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload Error: ' . $this->upload->display_errors('', ''); 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('filtitle');
    }

 	private function validate_work_records(){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('title') == ''){
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('description') == ''){
            $data['inputerror'][] = 'description';
            $data['error_string'][] = 'description is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('added_date') == ''){
            $data['inputerror'][] = 'added_date';
            $data['error_string'][] = 'Date is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}