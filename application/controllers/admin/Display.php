<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* display Controoler
*/
class Display extends Admin_Controller{
	 	
 	function __construct(){
 		parent::__construct();
 		$this->load->model('admin/roles/roles_model','role');
 		$this->load->model('admin/users/users_model','user');
 		$this->load->model('admin/display/display_model','display');
 	}

 	public function index(){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
            $data['title'] = $this->sspname.'display';
            $data['roleResults'] = $this->role->get_emp_roles();
     		$this->render_template('admin/display/index', $data);
        }else{
            $this->render_403_template();
        }
 	}

 	public function generate_display(){
 		$list = $this->display->get_display_information();
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
            	$row[] = '<img src="'.base_url('uploads/displays/'.$record->photo).'" style="height:50px; width:auto" onclick="view_photo('."'".$record->id."'".')" />
            	';
            }
            $row[] = $record->slide;
            $row[] = $record->info;
            $row[] = $record->btn_text;
            $row[] = $record->created_date;
            $row[] = '
                <div class="dropdown text-center">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                        data-toggle="dropdown">Actions<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="text-success" href="javascript:void(0)" 
                            onclick="view_display(' . "'" . $record->id . "'" . ')">
                            <i class="fa fa-eye"></i>View</a>
                        </li>
                        <li><a class="text-primary" href="javascript:void(0)" 
                            onclick="update_display(' . "'" . $record->id . "'" . ')">
                            <i class="fa fa-edit"></i>Edit</a>
                        </li>
                        <li><a class="text-danger" href="javascript:void(0)" 
                            onclick="delete_display(' . "'" . $record->id . "'" . ',' . "'" . $record->slide . "'" . ')">
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
            "recordsTotal" => $this->display->count_all_display(),
            "recordsFiltered" => $this->display->count_filtered_display(),
            "data" => $data,
            );
        //output to json format
	    echo json_encode($output);
 	}

    public function get_records_by_display_id($id){
        $data = $this->display->get_display_by_id($id);
        echo json_encode($data);
	}

 	public function add_new_display(){
        $this->validate_display_records();
        $slide = $this->input->post('slide');
        $data = array(
         	'slide'    => $this->input->post('slide'),
            'info'         => $this->input->post('info'),
            'btn_text'         => $this->input->post('btn_text'),
            'created_date'    => $this->input->post('created_date')
        );
        //check for existence
        $checkexistslide = $this->display->check_slide($slide);
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # check if the added display id already taken...
            if($checkexistslide > 0){
            	echo  json_decode("slide_exists");
            }else{
            	# check if the display photo is being uploaded
            	if (!empty($_FILES['photo']['name'])) {
		            $upload = $this->do_upload_display_photo();
		            $data['photo'] = $upload;
		        }
                $insert = $this->display->save_display_record($data);
                echo json_encode(array("status" => TRUE));
            } 
        }else{
            echo json_encode("access_denied");
        } 
    }

    // update display
    public function update_display_records(){
        $data = array(
            'slide'    => $this->input->post('slide'),
            'info'         => $this->input->post('info'),
            'btn_text'         => $this->input->post('btn_text'),
            'created_date'    => $this->input->post('created_date')
        );
        $id = $this->input->post('displayid');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
        	if (!empty($_FILES['photo']['name'])) {
	            $upload = $this->do_upload_display_photo();
	            # Removing the existing display profile picture
	            $displayRow = $this->display->get_display_by_id($this->input->post('displayid'));
	            if(file_exists('uploads/displays/'.$displayRow->photo) && $displayRow->photo){
	                unlink('uploads/displays/'.$displayRow->photo);
	            }
	            $data['photo'] = $upload;
            }
            $this->display->update_display_record($id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function delete_display_record($id){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
        	# Removing the existing display picture
            $displayRow = $this->display->get_displays_info_by_id($id);
            if(file_exists('uploads/displays/'.$displayRow->photo) && $displayRow->photo){
                unlink('uploads/displays/'.$displayRow->photo);
            }
            # delete display information from display information
            $this->display->delete_by_id($id);
            # delete display information from transaction table
            $this->users_model->delete_emp_by_id($id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_display_delete(){
        $selecteddisplayID = $this->input->post('id');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            foreach ($selecteddisplayID as $did) {
            	# Removing the existing display picture
	            $displayRow = $this->display->get_displays_info_by_id($did);
	            if(file_exists('uploads/displays/'.$displayRow->photo) && $displayRow->photo){
	                unlink('uploads/displays/'.$displayRow->photo);
	            }
                # delete display information from display table
                $this->display->delete_by_id($did);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    private function do_upload_display_photo() {
    	$displayName = $this->input->post('slide');
        $config['upload_path'] = './uploads/displays/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']             = 85700; //set max size allowed in Kilobyte
        $config['max_width']            = 5346; // set max width image allowed
        $config['max_height']           = 3568; // set max height allowed
        //$config['file_name'] = round(microtime(true) * 1000);
        $config['file_name'] = $displayName; 
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

 	private function validate_display_records(){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('slide') == ''){
            $data['inputerror'][] = 'slide';
            $data['error_string'][] = 'slide is required';
            $data['status'] = FALSE;
        }
        
        if ($this->input->post('created_date') == ''){
            $data['inputerror'][] = 'created_date';
            $data['error_string'][] = 'Join date is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}