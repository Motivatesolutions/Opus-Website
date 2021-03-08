<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PDN Website
 */
class Contact extends Client_Controller{
	
	public function __construct(){
		parent::__construct();
        $this->load->model('admin/modules/subscriber_model','subscriber');
	}

	public function index(){
        $this->render_template('contact');
	}

	public function subscribe_now(){
        if ($this->input->post('email') == '') {
            echo json_encode("email_required");
        }else{
            // check if e-mail address is well-formed
            if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
                echo json_encode("invalid_email");
            }else{
                // every thing is successful
                $data = array(
                    'email' => $this->input->post('email'),
                    ' subscribe_date' =>date('Y-m-d h:i:s a')
                );
                //check for existence
                $checkEmailNo = $this->subscriber->check_subscriber_email($this->input->post('email'));
                # check if subscriber email has already subscribed
                if($checkEmailNo > 0){
                    echo json_encode("email_exists");
                }else{
                    // successful
                    $insert = $this->subscriber->save_subscriber_record($data);
                    echo json_encode(array("status" => TRUE));
                }
            }
        }
    }
    
    public function send_contact_form(){
        if ($this->input->post('email') == '') {
            # email is required
            $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
            Message Error: Please, fill the required fields!',2);
            $this->render_template('contact');
        }else{
            // check if e-mail address is well-formed
            if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
                $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
                Message Error: Please, Email is Invalide!',2);
                $this->render_template('contact');
            }else{
                // every thing is successful
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $subject = $this->input->post('subject');
                $message = $this->input->post('message');
                $data = "<h4>".$name."</h4><br><i>".$email."</i><br>". $subject."<br>".$message;
                $this->settings->send_contact_message($data);
                if($data == TRUE){
                # display message success
                    $this->session->set_flashdata('success', '<i class="fa fa-check"></i>Message Sent Successfully!',2);
                    $this->render_template('contact');
                }else{
                    # email is required
                    $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
                    Message Error: Please, Message was not sent!',2);
                    $this->render_template('contact');
                }
            }
        }
	}

    

    private function validate_contact_records()
    {

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
        if ($this->input->post('subject') == '') {
            $data['inputerror'][] = 'subject';
            $data['error_string'][] = 'subject is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('message') == '') {
            $data['inputerror'][] = 'message';
            $data['error_string'][] = 'message is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

	public function show_404(){
        $data['title']="404 - Page Not Found";
        $this->load->view('errors/404',$data);
    }
}