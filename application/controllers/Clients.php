<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Tymex Website
 */
class Clients extends Client_Controller{
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){
        $data['presentersResults'] = $this->employee->get_presenters_info(8);
        $data['artistResults'] = $this->artist->get_artist_info(8);
        $this->render_template('artists',$data);
    }


    public function get_records_by_id($artist_id){
        $data = $this->artists->get_by_artist_id($artist_id);
        $this->render_template('singleartist',$data);
	}

    public function singleartist($artist_id){
        $data['artistRow']=$this->artist->get_artist_by_id($artist_id);
        $data['trackRows']=$this->track->get_track_by_artist($artist_id);
        $data['artistResults'] = $this->artist->get_artist_info(8);
        $this->load->view('single_artist',$data);
    }
}