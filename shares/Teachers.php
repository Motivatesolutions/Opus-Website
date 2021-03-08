<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teachers extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/class/class_model','class');
        $this->load->model('admin/section/section_model','section');
        $this->load->model('admin/section/school_model','school');
        $this->load->model('admin/student/student_model','student');
        $this->load->model('admin/teacher/teacher_model','teacher');
        $this->load->model('admin/roles/roles_model','role');
        $this->load->model('admin/users/users_model','user');
    }
    
    public function section($school, $school_id, $school_name_slug){
        $data['title'] = $this->sspname.'Teachers';
        $data['roleResults'] = $this->role->get_roles();
        # geting school row information
        $schoolRow = $this->school->get_school_info_by_school_id($school_id);
        $section_id = $schoolRow['section_id'];
        $section_name = $schoolRow['section_name'];
        # passing section id and section name to the view
        $data['school_id'] = $school_id;
        $data['section_id'] = $section_id;
        $data['section_name'] = $section_name;
        $data['school_name'] = $schoolRow['school_name'];
        $this->render_template('admin/class/teacher', $data);
    }

    
     public function generate_teacher($school_id){
        $condition = array('school_id' => $school_id);
        $list = $this->teacher->get_teacher_information($condition);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record) {
            $no++;
            $row = array();
            $row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'. $record->id.'">
            </div>';
            $row[] = $no;
             if ($record->photo == "") {
                $row[] = '<img src="'.base_url('uploads/users/nophoto.jpg').'" style="height:20px; width:20px" class="" onclick="view_photo('."'".$record->id."'".')" />
                ';
            }else{
                $row[] = '<img src="'.base_url('uploads/teachers/'.$record->photo).'" style="height:50px; width:auto" onclick="view_photo('."'".$record->id."'".')" />
                ';
            }
            $row[] = $record->name;
            $row[] = $record->address;
            $row[] = $record->phone;
            $row[] = $record->email;
            $row[] = '<div class="dropdown text-center">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                            data-toggle="dropdown">Actions<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="text-success" href="javascript:void(0)" 
                                onclick="view_teacher(' . "'" . $record->id . "'" . ')">
                                <i class="fa fa-eye"></i>View Teacher</a>
                            </li>
                            <li><a class="text-primary" href="javascript:void(0)" 
                                onclick="update_teacher(' . "'" . $record->id . "'" . ')">
                                <i class="fa fa-edit"></i>Edit Teacher</a>
                            </li>
                            <li><a class="text-danger" href="javascript:void(0)" 
                                onclick="delete_teacher(' . "'" . $record->id . "'" . ',' . "'" . $record->name . "'" . ')">
                                <i class="fa fa-trash"></i> Delete Teacher</a>
                            </li>
                        </ul>
                    </div>
                ';
            //add html for action
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal"    => $this->teacher->count_all_teacher($condition),
            "recordsFiltered" => $this->teacher->count_filtered_teacher($condition),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_records_by_techer_id($teacher_id){
        $data = $this->teacher->get_by_teacher_id($teacher_id);
        echo json_encode($data);
    }

    public function add_new_teacher(){
        $this->validate_teacher_records();
        $email = $this->input->post('email');
        $name  = $this->input->post('name');
        $contact  = $this->input->post('contact');
        $password = $this->generate_teacher_password();

        $data = array(
            'section_id' => $this->input->post('section_id'),
            'school_id' => $this->input->post('school_id'),
            'name'      => $this->input->post('name'),
            'department'=> $this->input->post('department'),
            'qualification'=> $this->input->post('qualification'),
            'designation' => $this->input->post('designation'),
            'sex'      => $this->input->post('gender'),
            'dob'      => $this->input->post('dob'),
            'address'     => $this->input->post('address'),
            'nationality' => $this->input->post('nationality'),
            'phone'=> trim(preg_replace('/^0/', '+256', $this->input->post('contact'))),
            'email'  => $this->input->post('email'),
            'created_date' => $this->input->post('created_date')
        );

        $Emailexist     = $this->teacher->check_email_exit($email);
        $TeacherNameexist = $this->teacher->check_teacher_name_exit($name);
        $Contactexist     = $this->teacher->check_contact_exit($contact);
        # check user permission
        if ($this->userdata['role'] == 5 || $this->userdata['role'] == 1) {
            # check if teacher name, contact & email already added...
            if($TeacherNameexist > 0){
                echo json_encode("teacher_name_exist");
            }
            elseif ($Emailexist > 0) {
                echo json_encode("email_exist");
            }
            elseif ($Contactexist > 0) {
                echo json_encode("contact_exist");
            } else{
                # check if the teacher photo is being uploaded
                if (!empty($_FILES['photo']['name'])) {
                    $upload = $this->do_upload_teacher_photo();
                    $data['photo'] = $upload;
                }
                $insert = $this->teacher->save_teacher_record($data);
                # creating Teacher's account automatically 
                $newData = array(
                    'role'       => $this->input->post('designation'),
                    'email'      => $this->input->post('email'),
                    'password'   => $password,
                    'status'     => 'active',
                    'name'       => $this->input->post('name'),
                    'phone'      => trim(preg_replace('/^0/', '+256', $this->input->post('contact'))),
                    'jdate'      => $this->input->post('created_date'),
                    'created_at' => date('Y-m-d'),
                    'user_id' => $insert

                );
                # check if the Teacher's photo is being uploaded in users dir
                if (!empty($_FILES['photo']['name'])) {
                    move_uploaded_file($_FILES['photo']['tmp_name'], './uploads/users/'.$upload);
                    $newData['photo'] = $upload;
                }
                $this->user->save_users($newData);
                echo json_encode(array("status" => TRUE));
            } 
        }else{
            echo json_encode("access_denied");
        }
    }

    public function update_teacher_records(){
        $this->validate_teacher_records();
        $teacherRole = $this->input->post('designation');
        $roleRow = $this->role->get_by_role_id($teacherRole);
        $roleName = $roleRow->name;
        $data = array(
            'designation' => $roleName,
            'name'        => $this->input->post('name'),
            'department'  => $this->input->post('department'),
            'qualification'=> $this->input->post('qualification'),
            'designation' => $this->input->post('designation'),
            'sex'      => $this->input->post('gender'),
            'dob'      => $this->input->post('dob'),
            'address'     => $this->input->post('address'),
            'nationality' => $this->input->post('nationality'),
            'phone'=> trim(preg_replace('/^0/', '+256', $this->input->post('contact'))),
            'email'  => $this->input->post('email'),
            'created_date' => $this->input->post('created_date')
        );
        $id = $this->input->post('teacherid');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            if (!empty($_FILES['photo']['name'])) {
                $upload = $this->do_upload_teacher_photo();
                # Removing the existing teacher profile picture
                $teacherRow = $this->teacher->get_by_teacher_id($this->input->post('teacherid'));
                if(file_exists('uploads/teachers/'.$teacherRow->photo) && $teacherRow->photo){
                    unlink('uploads/teachers/'.$teacherRow->photo);
                }
                $data['photo'] = $upload;
            }
            $this->teacher->update_teacher_record($id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function generate_teacher_password(){
      $chars = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ023456789!@#$%^&*()_=";
      $password = substr(str_shuffle($chars ),0,10 );
      return $password;
    }

    public function delete_teacher_record($teacher_id){
        # check teacher permission
        if ($this->userdata['role'] == 5 || $this->userdata['role'] == 1) {
            # Removing the existing teacher picture
            $teacherRow = $this->teacher->get_teachers_info_by_teacher_id($teacher_id);
            if(file_exists('uploads/teachers/'.$teacherRow->photo) && $teacherRow->photo){
                unlink('uploads/teachers/'.$teacherRow->photo);
            }
            # delete teacher information from teacher information
            $this->teacher->delete_by_teacher_id($teacher_id);
            # delete teacher's information from user table
            $this->user->delete_teacher_by_teacher_id($teacher_id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_teacher_delete(){
        $selectedTeacherID = $this->input->post('id');
        # check user permission
        if ($this->userdata['role'] == 5 || $this->userdata['role'] == 1) {
            foreach ($selectedTeacherID as $teacherid) {
                # Removing the existing Teacher picture
                $teacherRow = $this->teacher->get_teachers_info_by_teacher_id($teacherid);
                if(file_exists('uploads/teachers/'.$teacherRow->photo) && $teacherRow->photo){
                    unlink('uploads/teachers/'.$teacherRow->photo);
                }
                # delete teacher information from teacher table
                $this->teacher->delete_by_teacher_id($teacherid);
                # delete teacher's information from user table
                $this->user->delete_teacher_by_teacher_id($teacher_id);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }
    
    private function do_upload_teacher_photo() {
        $teacherName = $this->input->post('name');
        $config['upload_path'] = './uploads/teachers/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']             = 8600; //set max size allowed in Kilobyte
        $config['max_width']            = 300; // set max width image allowed
        $config['max_height']           = 300; // set max height allowed
        //$config['file_name'] = round(microtime(true) * 1000);
        $config['file_name'] = $teacherName; 
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

    private function validate_teacher_records(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('name') == '') {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'name is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'email is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'email is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('gender') == '') {
            $data['inputerror'][] = 'gender';
            $data['error_string'][] = 'gender is required';
            $data['status'] = FALSE;
        }
         if ($this->input->post('department') == '') {
            $data['inputerror'][] = 'department';
            $data['error_string'][] = 'department is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('contact') == '') {
            $data['inputerror'][] = 'contact';
            $data['error_string'][] = 'contact is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('qualification') == '') {
            $data['inputerror'][] = 'qualification';
            $data['error_string'][] = 'qualification is required';
            $data['status'] = FALSE;
        }
        
        if ($this->input->post('designation') == '') {
            $data['inputerror'][] = 'designation';
            $data['error_string'][] = 'designation is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nationality') == '') {
            $data['inputerror'][] = 'nationality';
            $data['error_string'][] = 'nationality is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('address') == '') {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'address is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('created_date') == '') {
            $data['inputerror'][] = 'created_date';
            $data['error_string'][] = 'created date is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

} 