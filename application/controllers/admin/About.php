<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* about Controoler
*/
class About extends Admin_Controller{
	 	
 	function __construct(){
 		parent::__construct();
 		$this->load->model('admin/roles/roles_model','role');
 		$this->load->model('admin/users/users_model','user');
 		$this->load->model('admin/about/about_model','about');
 	}

 	public function index(){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
     		$data['title'] = $this->sspname.'about';
            $data['roleResults'] = $this->role->get_emp_roles();
     		$this->render_template('admin/about/index', $data);
        }else{
            $this->render_403_template();
        }
 	}

 	public function generate_about(){
 		$list = $this->about->get_about_information();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record){
            $no++;
            $row = array();
            $row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.$record->id.'"></div>';
            $row[] = $no;
            $row[] = $record->about;
            $row[] = $record->mission;
            $row[] = $record->vision;
            $row[] = $record->services;
            $row[] = $record->more;
            $row[] = $record->existence;
            $row[] = '
                <div class="dropdown text-center">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                        data-toggle="dropdown">Actions<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="text-success" href="javascript:void(0)" 
                            onclick="view_about(' . "'" . $record->id . "'" . ')">
                            <i class="fa fa-eye"></i>View</a>
                        </li>
                        <li><a class="text-primary" href="javascript:void(0)" 
                            onclick="update_about(' . "'" . $record->id . "'" . ')">
                            <i class="fa fa-edit"></i>Edit</a>
                        </li>
                        <li><a class="text-danger" href="javascript:void(0)" 
                            onclick="delete_about(' . "'" . $record->id . "'" . ',' . "'" . $record->about . "'" . ')">
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
            "recordsTotal" => $this->about->count_all_about(),
            "recordsFiltered" => $this->about->count_filtered_about(),
            "data" => $data,
            );
        //output to json format
	    echo json_encode($output);
 	}

    public function get_records_by_about_id($id){
        $data = $this->about->get_about_by_id($id);
        echo json_encode($data);
	}

 	public function add_new_about(){
        $this->validate_about_records();
        $about = $this->input->post('about');
        $data = array(
            'about'    => $this->input->post('about'),
            'mission'         => $this->input->post('mission'),
            'vision'    => $this->input->post('vision'),
            'services'    => $this->input->post('services'),
            'more'         => $this->input->post('more'),
            'existence'         => $this->input->post('existence'),
            'created_date'    => $this->input->post('created_date')
        );
        //check for existence
        $checkexistabout = $this->about->check_about($about);
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # check if the added about id already taken...
            if($checkexistabout > 0){
            	echo  json_decode("about_exists");
            }else{
                # check if the about photo being uploaded
            	if (!empty($_FILES['aboutimage']['name'])) {
		            $upload = $this->do_upload_About_photo();
		            $data['aboutimage'] = $upload;
		        }
                $insert = $this->about->save_about_record($data);
                echo json_encode(array("status" => TRUE));
            } 
        }else{
            echo json_encode("access_denied");
        } 
    }

	public function update_about_records(){
        $data = array(
            'about'    => $this->input->post('about'),
            'mission'         => $this->input->post('mission'),
            'vision'    => $this->input->post('vision'),
            'services'    => $this->input->post('services'),
            'more'         => $this->input->post('more'),
            'existence'         => $this->input->post('existence'),
            'created_date'    => $this->input->post('created_date')
        );
        $id = $this->input->post('aboutid');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            if (!empty($_FILES['aboutimage']['name'])) {
	            $upload = $this->do_upload_About_photo();
	            # Removing the existing about picture
	            $aboutRow = $this->about->get_about_by_id($this->input->post('aboutid'));
	            if(file_exists('uploads/about/'.$aboutRow->aboutimage) && $aboutRow->aboutimage){
	                unlink('uploads/about/'.$aboutRow->aboutimage);
	            }
	            $data['aboutimage'] = $upload;
            }
            $this->about->update_about_record($id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function delete_about_record($id){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # delete about information from about information
            $this->about->delete_by_id($id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_about_delete(){
        $selectedaboutID = $this->input->post('id');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            foreach ($selectedaboutID as $aid) {
            	
                # delete about information from about table
                $this->about->delete_by_id($aid);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    private function do_upload_About_photo() {
    	$about = $this->input->post('about');
        $config['upload_path'] = './uploads/about/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']             = 85700; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1053; // set max height allowed
        //$config['file_name'] = round(microtime(true) * 1000);
        $config['file_name'] = $about; 
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('aboutimage')) { //upload and validate
            $data['inputerror'][] = 'aboutimage';
            $data['error_string'][] = 'Upload Error: ' . $this->upload->display_errors('', ''); 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

 	private function validate_about_records(){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('about') == ''){
            $data['inputerror'][] = 'about';
            $data['error_string'][] = 'about is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('mission') == ''){
            $data['inputerror'][] = 'mission';
            $data['error_string'][] = 'mission is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('vision') == ''){
            $data['inputerror'][] = 'vision';
            $data['error_string'][] = 'vision is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('services') == ''){
            $data['inputerror'][] = 'services';
            $data['error_string'][] = 'services is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('more') == ''){
            $data['inputerror'][] = 'more';
            $data['error_string'][] = 'more is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('created_date') == ''){
            $data['inputerror'][] = 'created_date';
            $data['error_string'][] = 'Date is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}