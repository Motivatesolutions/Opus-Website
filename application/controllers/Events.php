<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PDN Website
 */
class Events extends Client_Controller{
	
	public function __construct(){
		parent::__construct();
        // load pagination library
        $this->load->library('pagination');
        $this->limit = 6;
	}

    public function index($offset = 0){
     $result = $this->event->get_events($this->limit, $offset);
     
     $data['event_list'] = $result['rows'];
     $data['num_results'] = $result['num_rows'];
     
     $config = array();
     
     $config['base_url'] = base_url("events/index");
     $config['total_rows'] = $data['num_results'];
     $config['per_page'] = $this->limit;
     
     //which uri segment indicates pagination number
     $config['uri_segment'] = 3;
     $config['use_page_numbers'] = TRUE;
     
     //max links on a page will be shown
     $config['num_links'] = 5;
     
     //various pagination configuration
     $config['full_tag_open'] = '<div class="pagination">';
     $config['full_tag_close'] = '</div>';
     $config['first_tag_open'] = '<span class="first">';
     $config['first_link'] = '';
     $config['first_tag_close'] = '&nbsp;</span>';
     $config['last_tag_open'] = '<span class="last">';
     $config['last_tag_close'] = '&nbsp;&nbsp;</span>';
     $config['last_link'] = '';
     $config['prev_tag_open'] = '<span class="prev bg-success border bordered pl-2 pr-2">&#171';
     $config['prev_tag_close'] = '&nbsp;</span>';
     $config['prev_link'] = '';
     $config['next_tag_open'] = '<span class="next bg-success border bordered pl-2 pr-2">&#187;';
     $config['next_tag_close'] = '</span>';
     $config['next_link'] = '';
     $config['cur_tag_open'] = '<span class="current bg-success border bordered pl-2 pr-2">';
     $config['cur_tag_close'] = '</span>';
     $config['show_count'] = true;
     
     $this->pagination->initialize($config);
     $data['pagination'] = $this->pagination->create_links();
     $data['upcomingeventsResults'] = $this->event->get_event_info(1);
     $this->render_template('pdn/events',$data);
    }

    public function singleevent($p_id){
        $data['eventRow']=$this->event->get_events_info_by_e_id($p_id);
        $data['eventResults'] = $this->event->get_event_info(6);
        $this->render_template('pdn/singleEvent',$data);
    }

	public function show_404(){
        $data['title']="404 - Page Not Found";
        $this->load->view('errors/404',$data);
    }
}