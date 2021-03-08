<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* service Controoler
*/
class Service extends Admin_Controller{
	 	
 	function __construct(){
 		parent::__construct();
 		$this->load->model('admin/roles/roles_model','role');
 		$this->load->model('admin/users/users_model','user');
 		$this->load->model('admin/service/service_model','service');
 	}

 	public function index(){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
     		$data['title'] = $this->sspname.'Services';
            $data['roleResults'] = $this->role->get_emp_roles();
     		$this->render_template('admin/service/index', $data);
        }else{
            $this->render_403_template();
        }
 	}

 	public function generate_service(){
 		$list = $this->service->get_service_information();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record){
            $no++;
            $row = array();
            $row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.
            			$record->id.'">
            		</div>';
            $row[] = $no;
            $row[] = $record->title;
            $row[] = $record->info;
            $row[] = $record->created_date;
            $row[] = '
                <div class="dropdown text-center">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                        data-toggle="dropdown">Actions<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="text-success" href="javascript:void(0)" 
                            onclick="view_service(' . "'" . $record->id . "'" . ')">
                            <i class="fa fa-eye"></i>View</a>
                        </li>
                        <li><a class="text-primary" href="javascript:void(0)" 
                            onclick="update_service(' . "'" . $record->id . "'" . ')">
                            <i class="fa fa-edit"></i>Edit</a>
                        </li>
                        <li><a class="text-danger" href="javascript:void(0)" 
                            onclick="delete_service(' . "'" . $record->id . "'" . ',' . "'" . $record->title . "'" . ')">
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
            "recordsTotal" => $this->service->count_all_service(),
            "recordsFiltered" => $this->service->count_filtered_service(),
            "data" => $data,
            );
        //output to json format
	    echo json_encode($output);
 	}

    public function get_records_by_service_id($id){
        $data = $this->service->get_by_id($id);
        echo json_encode($data);
	}

 	public function add_new_service(){
        $this->validate_service_records();
        $title = $this->input->post('title');
        $data = array(
         	'title'    => $this->input->post('title'),
            'info'         => $this->input->post('info'),
            'created_date'    => $this->input->post('created_date')
        );
        //check for existence
        $checkexisttitle = $this->service->check_service($title);
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # check if the added service id already taken...
            if($checkexisttitle > 0){
            	echo  json_decode("service_exists");
            }else{
                $insert = $this->service->save_service_record($data);
                echo json_encode(array("status" => TRUE));
            } 
        }else{
            echo json_encode("access_denied");
        } 
    }
    

	public function update_service_records(){
        $data = array(
            'title'    => $this->input->post('title'),
            'info'         => $this->input->post('info'),
            'created_date'    => $this->input->post('created_date')
        );
        $id = $this->input->post('serviceid');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
        	
            $this->service->update_service_record($id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function delete_service_record($id){
        # check user permission
        if ($this->userdata['role'] == 1) {
            # delete service information from service information
            $this->service->delete_by_id($id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_service_delete(){
        $selectedETitle = $this->input->post('id');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
            foreach ($selectedETitle as $id) {
                # perform email subscription deletion
                $this->service->delete_by_id($id);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

 	private function validate_service_records(){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('title') == ''){
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('info') == ''){
            $data['inputerror'][] = 'info';
            $data['error_string'][] = 'service of the day is required';
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