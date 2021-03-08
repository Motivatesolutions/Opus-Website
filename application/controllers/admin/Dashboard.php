<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Dashboard
 * created on 04.10.2018 08:00am
 */
class Dashboard extends Admin_Controller{
	
	public function __construct(){
		parent::__construct();
        $this->adminLoggedIn();
	}

	public function index(){	
        $data['title'] = $this->sspname."Dashboard";
        $data['ArtistResults'] = $this->artist->get_artist_info(3);
        $data['firstslide'] = $this->display->get_first_slide();
        $data['nextslide'] = $this->display->get_next_slide();
        $data['lastslide'] = $this->display->get_last_slide();
        $data['roleResults'] = $this->role->get_emp_roles();
        $data['employee_count'] = $this->employee->count_total_employees();
        $data['blog_count'] = $this->blog->count_all_blogs();
        $data['subscriber_count'] = $this->subscriber->count_all_subscriber();
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
            $this->render_template('admin/dashboard/index', $data);
        }else{
            
        }
    }

    function adminLoggedIn() {
        $adminLoggedIn = $this->session->userdata('adminLoggedIn');
        if (!isset($adminLoggedIn) || $adminLoggedIn != TRUE) {
            redirect(base_url());
        }
    }
    
    function logOut() {
        $this->session->sess_destroy();
        redirect(base_url());
    }


    public function update_profile(){
        $this->_validate();
        $user_id = $_SESSION['id'];
        $data  = array(
            'name' => $this->input->post('uname'), 
            'role' => $this->input->post('urole')
            );
        if (!empty($_FILES['imglink']['name'])) {
            $upload = $this->do_upload_photo();
            # Removing the existing user photo
            $results = $this->users_model->get_user_by_id($user_id);
            if(file_exists('uploads/users/'.$results->photo) && $results->photo){
                unlink('uploads/users/'.$results->photo);
            }

            $data['photo'] = $upload;
        }

        $this->users_model->update_status($user_id, $data);
        echo json_encode(array("status" => TRUE));
    }

    private function do_upload_photo() {
        $name = strtoupper($_POST['uname']);
        $config['upload_path'] = 'uploads/users/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 500;
        $config['file_name'] = trim($name);
        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('imglink')) { //upload and validate
            $data['inputerror'][] = 'imglink';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); 
            $data['status'] = FALSE;
            echo $this->upload->display_errors('', ''); 
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('uname') == '') {
            $data['inputerror'][] = 'uname';
            $data['error_string'][] = 'User Name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('urole') == '') {
            $data['inputerror'][] = 'urole';
            $data['error_string'][] = 'User Role is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }

    }

    public function update_account_password(){
        $this->_validate_user_password();
        $current_pass = $this->input->post("password");
        $password = $this->input->post("confirm_password");
        $id = $this->userdata['id'];
        # confirm password
        if ($current_pass == $password && strlen($password) >= 8) {
            $this->users_model->change_password($id,$password);
            echo json_encode(array("status" => TRUE));
        }else if (strlen($password) < 8) {
            echo json_encode("password_short");
        } else{
            echo json_encode("password_mismatch");
        }
    }

    private function _validate_user_password(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('password') == '')
        {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'New Password required';
            $data['status'] = FALSE;
        }

        if($this->input->post('confirm_password') == '')
        {
            $data['inputerror'][] = 'confirm_password';
            $data['error_string'][] = 'Confirm Password required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }


    public function admin(){    
        if ($this->userdata['role'] == 5) {
            # access grated
            $data['title'] = $this->sspname."System Scription Information";
            $this->render_template('admin/settings/index', $data);
        } else {
            # access denied
            $this->render_403_template();
        }
    }

    public function system_subscription(){
        $this->validate_subscription();
        $subcribe_email = 'danfodioeleku@gmail.com';
        $system_id = $this->systemdata->sid;
        $email = $this->input->post('email');
        $expiry_date = $this->input->post('sdate');
        $data = array(
            'system_id' =>  $system_id,
            'amount_paid' => $this->input->post('amount'),
            'expiry_date' => $expiry_date, 
            );
        if(!$this->userdata['role'] == 5) {
            # access denied
            echo json_encode("access_denied");
        }else{
            # check email
            if ($subcribe_email == $email) {
                # update sdate...
                $update_status = $this->settings->update_subcription_date($system_id,$expiry_date);
                # check if update is successful
                if ($update_status == TRUE) {
                    # insert subscription...
                    $insert = $this->settings->save_system_subscription($data);
                    echo json_encode(array("status" => TRUE));
                }
                
            }else{
                echo json_encode("incorrect_email");
            }
        }
    }

    private function validate_subscription(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email Address is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('sdate') == '') {
            $data['inputerror'][] = 'sdate';
            $data['error_string'][] = 'Subscription Date is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('amount') == '') {
            $data['inputerror'][] = 'amount';
            $data['error_string'][] = 'Amount Paid is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
    
}