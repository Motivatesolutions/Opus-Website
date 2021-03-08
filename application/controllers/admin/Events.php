<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* event Controoler
*/
class Events extends Admin_Controller{
	 	
 	function __construct(){
 		parent::__construct();
 		$this->load->model('admin/roles/roles_model','role');
 		$this->load->model('admin/users/users_model','user');
        $this->load->model('admin/event/event_model','event'); 
 	}

 	public function index(){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
     		$data['title'] = $this->sspname.'Event';
            $data['roleResults'] = $this->role->get_emp_roles();
     		$this->render_template('admin/event/index', $data);
        }else{
            $this->render_403_template();
        }
 	}

 	public function generate_event(){
 		$list = $this->event->get_event_information();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record){
            $no++;
            $row = array();
            $row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.
            			$record->e_id.'">
            		</div>';
            $row[] = $no;
            if ($record->photo == "") {
            	$row[] = '<img src="'.base_url('uploads/users/nophoto.jpg').'" style="height:20px; width:20px" class="" onclick="view_photo('."'".$record->e_id."'".')" />
            	';
            }else{
            	$row[] = '<img src="'.base_url('uploads/events/'.$record->photo).'" style="height:50px; width:auto" onclick="view_photo('."'".$record->e_id."'".')" />
            	';
            }
            $row[] = $record->e_name;
            $row[] = $record->description;
            $row[] = $record->event_date;
            $row[] = '
                <div class="dropdown text-center">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                        data-toggle="dropdown">Actions<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="text-success" href="javascript:void(0)" 
                            onclick="view_event(' . "'" . $record->e_id . "'" . ')">
                            <i class="fa fa-eye"></i>View</a>
                        </li>
                        <li><a class="text-primary" href="javascript:void(0)" 
                            onclick="update_event(' . "'" . $record->e_id . "'" . ')">
                            <i class="fa fa-edit"></i>Edit</a>
                        </li>
                        <li><a class="text-danger" href="javascript:void(0)" 
                            onclick="delete_event(' . "'" . $record->e_id . "'" . ',' . "'" . $record->e_name . "'" . ')">
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
            "recordsTotal" => $this->event->count_all_event(),
            "recordsFiltered" => $this->event->count_filtered_event(),
            "data" => $data,
            );
        //output to json format
	    echo json_encode($output);
 	}

    public function get_records_by_prog_id($e_id){
        $data = $this->event->get_by_e_id($e_id);
        echo json_encode($data);
	}

 	public function add_new_event(){
        $this->validate_event_records();
        $e_name = $this->input->post('e_name');
        $data = array(
             'e_name'    => $this->input->post('e_name'),
             'youtube'    => $this->input->post('youtube'),
            'description'         => $this->input->post('description'),
            'event_date'    => $this->input->post('event_date')
        );
        //check for existence
        $checkexiste_name = $this->event->check_event($e_name);
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # check if the added event id already taken...
            if($checkexiste_name > 0){
            	echo  json_decode("event_exists");
            }else{
            	# check if the event photo is being uploaded
            	if (!empty($_FILES['photo']['name'])) {
		            $upload = $this->do_upload_event_photo();
		            $data['photo'] = $upload;
                }
                
                $insert = $this->event->save_event_record($data);
                # creating employee accounts automatically
                $newData = array(
                	'e_name'       => $this->input->post('e_name'),
                	'description'      =>  $this->input->post('description'),
                	'event_date'       =>  $this->input->post('event_date')
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

	public function update_event_records(){
        $data = array(
            'e_name'    => $this->input->post('e_name'),
            'youtube'    => $this->input->post('youtube'),
            'description'         => $this->input->post('description'),
            'event_date'    => $this->input->post('event_date')
        );
        $id = $this->input->post('eventid');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
        	if (!empty($_FILES['photo']['name'])) {
	            $upload = $this->do_upload_event_photo();
	            # Removing the existing event profile picture
	            $eventRow = $this->event->get_by_e_id($this->input->post('eventid'));
	            if(file_exists('uploads/events/'.$eventRow->photo) && $eventRow->photo){
	                unlink('uploads/events/'.$eventRow->photo);
	            }
	            $data['photo'] = $upload;
            }
            $this->event->update_event_record($id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function delete_event_record($e_id){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
        	# Removing the existing event picture
            $eventRow = $this->event->get_events_info_by_e_id($e_id);
            if(file_exists('uploads/events/'.$eventRow->photo) && $eventRow->photo){
                unlink('uploads/events/'.$eventRow->photo);
            }
            # delete event information from event information
            $this->event->delete_by_e_id($e_id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_event_delete(){
        $selectedeventID = $this->input->post('e_id');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            foreach ($selectedeventID as $pid) {
            	# Removing the existing event picture
	            $eventRow = $this->event->get_events_info_by_e_id($pid);
	            if(file_exists('uploads/events/'.$eventRow->photo) && $eventRow->photo){
	                unlink('uploads/events/'.$eventRow->photo);
	            }
                # delete event information from event table
                $this->event->delete_by_e_id($pid);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    private function do_upload_event_photo() {
    	$eventName = $this->input->post('e_name');
        $config['upload_path'] = './uploads/events/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']             = 8400; //set max size allowed in Kilobyte
        $config['max_width']            = 800; // set max width image allowed
        $config['max_height']           = 600; // set max height allowed
        //$config['file_name'] = round(microtime(true) * 1000);
        $config['file_name'] = $eventName; 
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

 	private function validate_event_records(){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('e_name') == ''){
            $data['inputerror'][] = 'e_name';
            $data['error_string'][] = 'Event name is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('description') == ''){
            $data['inputerror'][] = 'description';
            $data['error_string'][] = 'description is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('youtube') == ''){
            $data['inputerror'][] = 'youtube';
            $data['error_string'][] = 'youtube link is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('event_date') == ''){
            $data['inputerror'][] = 'event_date';
            $data['error_string'][] = 'Date is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}