<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Tymex Website
 */
class About extends Client_Controller{
	
	public function __construct(){
		parent::__construct();
          // Load pagination library 
        $this->load->library('pagination'); 
        // Per page limit 
        $this->limit = 8; 
	}

	public function index(){
        $data['presentersResults'] = $this->employee->get_presenters_info(8);
        $this->render_template('about',$data);
    }


    public function get_records_by_id($P_id){
        $data = $this->programs->get_by_p_id($P_id);
        $this->render_template('pdn/singleradioprogram',$data);
	}

    public function singleprogram($p_id){
        $data['programRow']=$this->programs->get_single_programs_p_id($p_id);
        $data['radioprogramResults'] = $this->programs->get_program_info(8);
        $this->render_template('pdn/singleradioprogram',$data);
    }
}