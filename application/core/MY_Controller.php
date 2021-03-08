<?php
/**
 * Admin Controller 
 */
class MY_Controller extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}
}


/**
 *  Administrator Module
 */
class Admin_Controller extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		
		if (empty($_SESSION['id'])){
			$this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  Session Expired: Your Login Session has Expired!<br> Please, Re-login Again!',2);
            redirect(base_url('admin/login'));
        }else{
        	$this->load->model('admin/service/service_model','service');
        	$this->load->model('admin/roles/roles_model','role');
        	$this->load->model('admin/employee/employee_model','employee');
			$this->load->model('admin/display/display_model','display');
			$this->load->model('admin/modules/subscriber_model','subscriber');
			$this->load->model('admin/blog/blog_model','blog');
			$this->load->model('admin/artist/track_model','track');
			 
			$this->load->model('admin/genre/genre_model','genre');
			$this->load->model('admin/genre/artist_model','artist');

        	# load users model
       		$this->load->model("users/users_Model","users_model");
	        $this->userdata = $this->users_model->get_user_details($_SESSION['id']);
	        
	        # load setting model
        	$this->load->model('admin/settings/settings_model','settings');
	        # get setting id maximun
	        $setting_id = $this->settings->get_maximum_setting_id();
	        # get system  information
	        $this->systemdata = $this->settings->get_setting_by_id($setting_id);
	        # check if the sname is not null
	        if ($this->systemdata->spname == '') {
	            $this->sspname = $this->systemdata->spname;
	        }else{
	            $this->sspname = $this->systemdata->spname.' | ';
	        }
	        # get system date
	        $currentDate = date('Y-m-d');
	        $system_date = $this->settings->get_system_date($this->systemdata->sid);
	        # check system termly running session with the current date
	        if ($currentDate <= $system_date) {
	        	# set system current date status...
	        	$this->systemstatus = TRUE;
	        }else{
	        	$this->systemstatus = FALSE;
	        }
        }
	}


	public function render_template($page = null, $data = array()){
		$data['uroles'] = $this->users_model->get_user_roles();
 		$this->load->view('admin/templates/header',$data);
		$this->load->view($page, $data);
		$this->load->view('admin/templates/footer',$data);
	}

	public function render_parentemplate($page = null, $data = array()){
 		$this->load->view('admin/templates/header',$data);
		$this->load->view($page, $data);
		$this->load->view('admin/templates/footer',$data);
	}

	public function render_404_template(){
		$data['title'] = "404 - Page Not Found";
        $this->load->view('errors/404',$data);
	}

	public function render_403_template(){
		$data['title'] = "403 - Access Denied!";
        $this->load->view('errors/403',$data);
	}
}


class Client_Controller extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
			$this->load->model('admin/service/service_model','service');
			$this->load->model('admin/display/display_model','display');
			$this->load->model('admin/event/event_model','event');
			$this->load->model('admin/blog/blog_model','blog');
			$this->load->model('admin/work/work_model','work');
			$this->load->model('admin/genre/artist_model','artist');
			$this->load->model('admin/artist/track_model','track');
			# load setting model
			$this->load->model('admin/settings/settings_model', 'settings');
			# get setting id maximun
			$setting_id = $this->settings->get_maximum_setting_id();
			# get system  information
			$this->systemdata = $this->settings->get_setting_by_id($setting_id);
			// load event model
			$this->load->model('admin/event/event_model','event');
			// load employee model
			$this->load->model('admin/employee/employee_model','employee');
			// load about model
			$this->load->model('admin/about/about_model','about');

			#get track  info
			$this->trackData = $this->track->get_track();
			#get artist artist info
			$this->teamData = $this->employee->get_team();
			#get about info
			$this->aboutData = $this->about->get_about();
			
	}

	public function render_template($page = null, $data = array())
	{
		$this->load->view('template/header', $data);
		$this->load->view($page, $data);
		$this->load->view('template/footer', $data);
	}

	public function render_404_template()
	{
		$data['title'] = "404 - Page Not Found";
		$this->load->view('errors/404', $data);
	}

	public function render_403_template()
	{
		$data['title'] = "404 - Page Not Found";
		$this->load->view('errors/403', $data);
	}

}