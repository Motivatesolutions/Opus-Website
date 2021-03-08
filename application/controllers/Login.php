<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('login/login_model','login');
        # load setting model
        $this->load->model('admin/settings/settings_model','settings');
        # get setting id maximun
        $setting_id = $this->settings->get_maximum_setting_id();
        # get system school information
        $this->systemdata = $this->settings->get_setting_by_id($setting_id);
        # check if the sname is not null
        if ($this->systemdata->spname == '') {
            $this->sspname = $this->systemdata->spname;
        }else{
            $this->sspname = $this->systemdata->spname.' | ';
        }

    }

    function index(){
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        $data['login_name'] = "Admin Login";
        $data['title'] = $this->sspname."Login";
        $data['login_type'] = 'Administrator';
        //$this->load->view('login/admin',$data);
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
            $data['login_name'] = "Admin Login";
            $data['title'] = $this->sspname."Login";
            $data['login_type'] = 'Administrator';
            $this->load->view('login/admin',$data);
        }else{
            redirect(base_url('admin/dashboard'));
        }
    }

    public function check_login(){
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        if($this->form_validation->run() == FALSE){
            $data['login_name']="Admin Login";
            $data['title'] = $this->sspname."Login";
            $this->load->view('login/admin',$data);

        }else{
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->login->check_admin_login($email, $password);

            if(count($result) > 0)
            {
                foreach ($result as $res)
                {

                    if ($res->status == "inactive")
                        break;
                    $_SESSION['id'] = $res->id;
                    $_SESSION['name'] = $res->name;
                    $_SESSION['role'] = $res->role;	

                    $sessionArray = array(                   
                        'role'=>$res->role,
                        'name'=>$res->name,
                        'isLoggedIn' => TRUE
                        );         
                    $this->session->set_userdata($sessionArray);
                    echo 'loggedin';
                }

                echo 'not_auth';
            }
            else
            {
                echo 'wrong';
            }
        }
    }

    public function show_404(){
        $data['title']="404 - Page Not Found";
        $this->load->view('errors/404',$data);
    }
}