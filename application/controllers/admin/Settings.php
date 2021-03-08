<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Settings  Controller handling System Settings Information 
 * created on 17.10.2019 10:30am
 */
 class Settings extends Admin_controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/settings/settings_model','settings');
	}
    
    public function index(){	
        $data['title'] = $this->sspname."System Setting Information";
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # access granted
            $this->render_template('admin/settings/system', $data);
        }else{
            # call access denied function
            $this->render_403_template();
        }
    }

    public function update_settings(){
        $this->_validate();
        $setting_id = $this->systemdata->sid;
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $data  = array(
            'sname' => $this->input->post('sname'), 
            'smotto' => $this->input->post('smotto'),
            'semail' => $this->input->post('semail'),
            'sphone' => $this->input->post('sphone'),
            'saddress' => $this->input->post('saddress'),
            'swurl' => $this->input->post('swurl'),
            'spname' => $this->input->post('spname'),
            'ug_address' => $this->input->post('ug_address'), 
            'ug_email' => $this->input->post('ug_email'),
            'ug_contact' => $this->input->post('ug_contact'),
            );
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
        	# access granted...
	        if (!empty($_FILES['logo']['name'])) {
	            $upload = $this->_do_upload();
	            # Removing the existing school logo
	            $logo_query = $this->settings->get_setting_by_id($setting_id);
	            if(file_exists('uploads/logo/'.$logo_query->sphoto) && $logo_query->sphoto){
	                unlink('uploads/logo/'.$logo_query->sphoto);
	            }

	            $data['sphoto'] = $upload;
	        }

	        $this->settings->update_settings($setting_id, $data);
	        //$this->settings->save_settings($data);
	        echo json_encode(array("status" => TRUE));
	    }else{
	    	# access denied...
	    	echo json_encode("access_denied");
	    }
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('sname') == '') {
            $data['inputerror'][] = 'sname';
            $data['error_string'][] = 'Radio Full Name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('spname') == '') {
            $data['inputerror'][] = 'spname';
            $data['error_string'][] = 'Radio Short Name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('sphone') == '') {
            $data['inputerror'][] = 'sphone';
            $data['error_string'][] = 'Telephone Number is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('saddress') == '') {
            $data['inputerror'][] = 'saddress';
            $data['error_string'][] = 'Address Name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('smotto') == '') {
            $data['inputerror'][] = 'smotto';
            $data['error_string'][] = 'School Motto is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('semail') == '') {
            $data['inputerror'][] = 'semail';
            $data['error_string'][] = 'Email Address is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('swurl') == '') {
            $data['inputerror'][] = 'swurl';
            $data['error_string'][] = 'Website URL Link is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('ug_address') == '') {
            $data['inputerror'][] = 'ug_address';
            $data['error_string'][] = 'UG address is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('ug_email') == '') {
            $data['inputerror'][] = 'ug_email';
            $data['error_string'][] = 'Ug email is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('ug_contact') == '') {
            $data['inputerror'][] = 'ug_contact';
            $data['error_string'][] = 'UG contact is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function _do_upload() {
        $config['upload_path'] = './uploads/logo/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']             = 8000; //set max size allowed in Kilobyte
        //$config['max_width']            = 290; // set max width image allowed
        //$config['max_height']           = 280; // set max height allowed
        $config['file_name'] = round(microtime(true) * 1000); 
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('logo')) { //upload and validate
            $data['inputerror'][] = 'logo';
            $data['error_string'][] = 'Upload Error: ' . $this->upload->display_errors('', ''); 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    public function update_backgound_photo(){
        # Getting maximun setting id
        $setting_id = $this->systemdata->sid;
        # check if the background photo is uploaded
        if (!empty($_FILES['backgroundImg']['name'])) {
            $upload = $this->_do_upload_background();
            # Removing the existing school background logo
            $logo_query = $this->settings->get_setting_by_id($setting_id);
            if(file_exists('uploads/logo/'.$logo_query->sbackgphoto) && $logo_query->sbackgphoto)
                unlink('uploads/logo/'.$logo_query->sbackgphoto);

            $data['sbackgphoto'] = $upload;

            $this->settings->update_settings($setting_id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            $data['inputerror'][] = 'backgroundImg';
            $data['error_string'][] = 'Upload Error: Please, select the background photo to be Updated!'; 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }  
    }

    private function _do_upload_background() {
        $config['upload_path'] = 'uploads/logo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['min_size']             = 8000; //set max size allowed in Kilobyte
        $config['min_width']            = 1127; // set max width image allowed
        $config['min_height']           = 600; // set max height allowed
        $config['file_name'] = round(microtime(true) * 1000); 
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('backgroundImg')) { //upload and validate
            $data['inputerror'][] = 'backgroundImg';
            $data['error_string'][] = 'Upload Error: ' . $this->upload->display_errors('', ''); 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    // event banner image

    public function update_event_banner_photo(){
        # Getting maximun setting id
        $setting_id = $this->systemdata->sid;
        # check if the background photo is uploaded
        if (!empty($_FILES['eventBannerImg']['name'])) {
            $upload = $this->_do_upload_event_banner();
            # Removing the existing school background logo
            $logo_query = $this->settings->get_setting_by_id($setting_id);
            if(file_exists('uploads/events/banner/'.$logo_query->eventbgimg) && $logo_query->eventbgimg)
                unlink('uploads/events/banner/'.$logo_query->eventbgimg);

            $data['eventbgimg'] = $upload;

            $this->settings->update_settings($setting_id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            $data['inputerror'][] = 'eventBannerImg';
            $data['error_string'][] = 'Upload Error: Please, select the event background photo to be Updated!'; 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }  
    }

    private function _do_upload_event_banner() {
        $config['upload_path'] = 'uploads/events/banner/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['min_size']             = 8000; //set max size allowed in Kilobyte
        $config['min_width']            = 1127; // set max width image allowed
        $config['min_height']           = 600; // set max height allowed
        $config['file_name'] = round(microtime(true) * 1000); 
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('eventBannerImg')) { //upload and validate
            $data['inputerror'][] = 'eventBannerImg';
            $data['error_string'][] = 'Upload Error: ' . $this->upload->display_errors('', ''); 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }



    // radio banner image

    public function update_radio_banner_photo(){
        # Getting maximun setting id
        $setting_id = $this->systemdata->sid;
        # check if the background photo is uploaded
        if (!empty($_FILES['radioBannerImg']['name'])) {
            $upload = $this->_do_upload_radio_banner();
            # Removing the existing school background logo
            $logo_query = $this->settings->get_setting_by_id($setting_id);
            if(file_exists('uploads/radio/banner/'.$logo_query->radiobgimg) && $logo_query->radiobgimg)
                unlink('uploads/radio/banner/'.$logo_query->radiobgimg);

            $data['radiobgimg'] = $upload;

            $this->settings->update_settings($setting_id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            $data['inputerror'][] = 'radioBannerImg';
            $data['error_string'][] = 'Upload Error: Please, select the radio background photo to be Updated!'; 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }  
    }

    private function _do_upload_radio_banner() {
        $config['upload_path'] = 'uploads/radio/banner/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['min_size']             = 1000; //set max size allowed in Kilobyte
        $config['min_width']            = 1127; // set max width image allowed
        $config['min_height']           = 600; // set max height allowed
        $config['file_name'] = round(microtime(true) * 1000); 
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('radioBannerImg')) { //upload and validate
            $data['inputerror'][] = 'radioBannerImg';
            $data['error_string'][] = 'Upload Error: ' . $this->upload->display_errors('', ''); 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    
    

}