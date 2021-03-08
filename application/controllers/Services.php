<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PDN Website
 */
class Services extends Client_Controller{
	
	public function __construct(){
		parent::__construct();
         // Load pagination library 
         $this->load->library('pagination'); 
         // Per page limit 
         $this->limit = 6; 
     }
 
     public function index(){
         $data['serviceResults'] = $this->service->get_service_info(6);
         $data['work1'] = $this->work->get_work();
         $data['work2'] = $this->work->get_next();
         $data['work3'] = $this->work->get_next3();
         $data['work4'] = $this->work->get_next4();
         $data['work5'] = $this->work->get_next5();
         $data['work6'] = $this->work->get_last_work();
         $data['service'] = $this->service->get_service();
         $data['service2'] = $this->service->get_next();
         $data['service3'] = $this->service->get_next3();
         $data['service4'] = $this->service->get_next4();
         $data['service5'] = $this->service->get_next5();
         $data['service6'] = $this->service->get_last();
        $this->render_template('what-we-do',$data);
	}

	public function show_404(){
        $data['title']="404 - Page Not Found";
        $this->load->view('errors/404',$data);
    }
}