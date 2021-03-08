<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PDN Website
 */
class Opus extends Client_Controller{
	
	public function __construct(){
        parent::__construct();
        // Load pagination library 
        $this->load->library('pagination'); 
        // Per page limit 
        $this->limit = 8; 
        $this->load->model('admin/modules/subscriber_model','subscriber');
	}

    public function index(){
        $data['results'] = $this->event->get_event_info(1);
        $data['eventsResults'] = $this->event->get_event_info(3);
        $data['serviceResults'] = $this->service->get_service_info(1);
        $data['firstslide'] = $this->display->get_first_slide();
        $data['nextslide'] = $this->display->get_next_slide();
        $data['lastslide'] = $this->display->get_last_slide();
        $data['service'] = $this->service->get_service();
         $data['service2'] = $this->service->get_next();
         $data['service3'] = $this->service->get_next3();
         $data['service6'] = $this->service->get_last();
        $this->render_template('index',$data);
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

    function send(){
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pdnafrica23@gmail.com';
        $mail->Password = '********';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('info@example.com', 'CodexWorld');
        $mail->addReplyTo('info@example.com', 'CodexWorld');
        
        // Add a recipient
        $mail->addAddress('john.doe@gmail.com');
        
        // Add cc or bcc 
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
    
    public function contactus(){
        $this->validate_contact_records();
        $name = $this->input->post('name'); 
        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
            echo json_encode("invalid_email");
        }else{
                // successful
            $message = "<h2>Hello!</h2><br><h4>".$subject."</h4><br>". $message;
            $this->settings->send_email($name,$message,$subject,$email);
            echo json_encode(array("status" => TRUE));
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