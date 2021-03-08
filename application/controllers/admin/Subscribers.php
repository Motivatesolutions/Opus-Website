<?php
 /**
  * Email Subscribers Controller
  */
class Subscribers extends Admin_Controller{

 	public function __construct(){
 		parent::__construct();
        $this->load->model('admin/modules/subscriber_model','subscriber');
    }

  	public function emails(){
 		$data['title'] = $this->sspname.'Email Subscribers Information';
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # access granted
            $this->render_template('admin/subscribers/email', $data);
        }else{
            # call access denied function
            $this->render_403_template();
        }
	}

  	public function generate_subscribers(){
 		$list = $this->subscriber->get_subscriber_information();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record) {
            $no++;
            $row = array();
		    $row[] = '<div class="text-center"><input type="checkbox" name="subid[]"   class="data-check" value="'.$record->id.'">
		        </div>';
            $row[] = $no;
            $row[] = $record->email;
            $row[] = $record->subscribe_date;
            $row[] = $record->status;
            if (strtolower($record->message) == 'pending') {
                $row[] = '<span class="text-primary">'.$record->message.'</span>';
            }else{
                $row[] = '<span class="text-success">'.$record->message.'</span>';
            }
            # hide delete button...
            /*$row[] = '
                <div class="text-center">
                    <button class="btn btn-primary btn-sm" onclick="view_email(' . "'" . $record->id . "'" . ')">View</button>
                </div>
            ';*/
        	$data[] = $row;
	    }
	    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->subscriber->count_all_subscriber(),
            "recordsFiltered" => $this->subscriber->count_filtered_subscriber(),
            "data" => $data,
            );
	    //output to json format
		echo json_encode($output);
	}


    public function get_records_by_id($id){
        $data = $this->subscriber->get_subscribe_by_id($id);
        echo json_encode($data);
    }

    public function bulk_email_delete(){
        $selectedEmailID = $this->input->post('id');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
            foreach ($selectedEmailID as $id) {
                # perform email subscription deletion
                $this->subscriber->delete_email_by_id($id);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function send_bulk_email(){
        $subid = $this->input->post('subid');
        $description = $this->input->post('content');
        $subject = strtoupper($this->input->post('subject'));
        # check whether one email account has been selected
        if (!empty($subid)) {
            # check user permission
            if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
                # code...
                $i = 0;
                foreach ($subid as $id) {
                    $subsquery = $this->subscriber->get_subscribe_by_id($id);
                    $email = $subsquery->email;
                    # Send Email
                    $message = "<h2>Hello!</h2><br><h4>".$subject."</h4><br>". $description;
                    $this->settings->send_email($message,$subject,$email);
                    # set sms status to sent
                    $data = array('message' => 'sent');
                    # update sms status
                    $this->subscriber->update_subscriber_record($id,$data);
                    $i++;
                }
                # display message success
                $this->session->set_flashdata('success', '<i class="fa fa-check"></i>  Message sent: Newsletter Message Sent Successfully!',2);
                redirect(base_url('admin/subscribers/emails'));
            }else{
                # access denied
                $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
                    You are not Authorized to send Message to the Subscribers!',2);
                redirect(base_url('admin/subscribers/emails'));
            }
        }else{
            # please select ateast one email
            $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
                Please select alteast one email from the table to send Newsletter emails!',2);
            redirect(base_url('admin/subscribers/emails'));
        }
    }

    public function reset_sent_email(){
        $selectedEmailID = $this->input->post('id');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
            foreach ($selectedEmailID as $id) {
                $data = array('message' => 'pending');
                # update sms status
                $this->subscriber->update_subscriber_record($id,$data);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }


}
