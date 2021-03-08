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
        // $data['customers_count'] = $this->customer->count_total_customers();
        // $data['savings_count'] = $this->savings->count_all_savings_account();
        // $data['total_account_balance'] = $this->savings->sumup_account_balance_amount();

        $data['customers_count'] = 0;
        $data['savings_count'] = 0;
        $data['total_account_balance'] = 0;
        $this->render_template('admin/dashboard/index', $data);
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

    public function do_upload(){
        $type = explode('.', $_FILES["photo"]["name"]);
        $type = strtolower($type[count($type)-1]);
        $url = "uploads/users/".uniqid(rand()).'.'.$type;
        if(in_array($type, array("jpg", "jpeg", "gif", "png")))
            if(is_uploaded_file($_FILES["photo"]["tmp_name"]))
                if(move_uploaded_file($_FILES["photo"]["tmp_name"],$url))
                    return $url=substr($url, 14);  
                return "";
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
}