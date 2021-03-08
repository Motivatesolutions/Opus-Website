<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Settings Moel
 */
class Settings_model extends CI_model{

	var $table = 'settings';
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function save_settings($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function get_maximum_setting_id(){
        $this->db->select_max('sid');
        $this->db->from($this->table);
        $query = $this->db->get();
        $data = $query->row();
        return $data->sid;
    }

    public function get_setting_by_id($id) {
    	$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('sid', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_settings($id, $data) {
        $this->db->where("sid",$id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function get_system_date($id){
        $this->db->select("DECODE(subscribe_date,'subcrdate') AS sdate");
        $this->db->from("settings");
        $this->db->where("sid", $id);
        $data = $this->db->get();
        $query = $data->row_array();
        return $query["sdate"];
    }

    function update_subcription_date($settings_id,$newdate){
        return $this->db->query("UPDATE settings SET subscribe_date = ENCODE('".$newdate."', 'subcrdate') WHERE sid = ".$settings_id);
    }

    public function save_system_subscription($data){
        $this->db->insert('subscription', $data);
        return $this->db->insert_id();
    }


    public function send_email($message,$subject,$sendTo){
        require_once APPPATH.'libraries/mailer/class.phpmailer.php';
        require_once APPPATH.'libraries/mailer/class.smtp.php';
        require_once APPPATH.'libraries/mailer/mailer_config.php';
        include APPPATH.'libraries/mailer/template/template.php';
        
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        try
        {
            $mail->SMTPDebug = 1;  
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'ssl'; 
            $mail->Host = HOST;
            $mail->Port = PORT;  
            $mail->Username = GUSER;  
            $mail->Password = GPWD;     
            $mail->SetFrom(GUSER, 'Administrator');
            $mail->Subject = $subject;
            $mail->IsHTML(true);   
            $mail->WordWrap = 0;

            $hello='<img src=https://www.saipali.education/new/wp-content/uploads/2019/06/saipali-logo_new.png><br>';
            $thanks = "<br><br><i><span style='color: green;'>You are getting this message because you subscribed for our Newsletter.</i><br/><br/>Thanks,<br/>Admin ".ucwords(strtolower($this->systemdata->sname))."<br/><br/>";

            $body = $hello.$message.$thanks;
            $mail->Body = $header.$body.$footer;
            $mail->AddAddress($sendTo);

            if(!$mail->Send()) {
                $error = 'Mail error: '.$mail->ErrorInfo;
                return array('status' => false, 'message' => $error);
            } else { 
                return array('status' => true, 'message' => '');
            }
        }
        catch (phpmailerException $e)
        {
            $error = 'Mail error: '.$e->errorMessage();
            return array('status' => false, 'message' => $error);
        }
        catch (Exception $e)
        {
            $error = 'Mail error: '.$e->getMessage();
            return array('status' => false, 'message' => $error);
        }
        
    }

    public function send_contact_message($data){
        require_once APPPATH.'libraries/mailer/class.phpmailer.php';
        require_once APPPATH.'libraries/mailer/class.smtp.php';
        require_once APPPATH.'libraries/mailer/mailer_config.php';
        
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        try
        {
            $mail->SMTPDebug = 1;  
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'ssl'; 
            $mail->Host = HOST;
            $mail->Port = PORT;  
            $mail->Username = GUSER;  
            $mail->Password = GPWD; 
            $mail->IsHTML(true);   
            $mail->WordWrap = 0;
            $body = $data;
            $mail->Body = $body;


            if(!$mail->Send()) {
                $error = 'Mail error: '.$mail->ErrorInfo;
                return array('status' => false, 'message' => $error);
            } else { 
                return array('status' => true, 'message' => '');
            }
        }
        catch (phpmailerException $e)
        {
            $error = 'Mail error: '.$e->errorMessage();
            return array('status' => false, 'message' => $error);
        }
        catch (Exception $e)
        {
            $error = 'Mail error: '.$e->getMessage();
            return array('status' => false, 'message' => $error);
        }
        
        
    }


}