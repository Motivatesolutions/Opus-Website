<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* track Controoler
*/
class Track extends Admin_Controller{
	 	
 	function __construct(){
 		parent::__construct();
 		$this->load->model('admin/roles/roles_model','role');
 		$this->load->model('admin/users/users_model','user');
 	}

 	
    public function track($artist_id, $artist_name_slug){
        $data['title'] = $this->sspname.'Tracks';
        $data['artistResults'] = $this->artist->get_artist();
        $data['genreResults'] = $this->genre->get_genres();
        # geting artist row information
        $artistRow = $this->artist->get_artist_info_by_artist_id($artist_id);
        $genre_id = $artistRow['genre_id'];
        $genre_name = $artistRow['genre_name'];
        # passing section id and section name to the view
        $data['artist_id'] = $artist_id;
        $data['genre_id'] = $genre_id;
        $data['genre_name'] = $genre_name;
        $data['artist_name'] = $artistRow['artist_name'];
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # access granted
            $this->render_template('admin/artist/track', $data);
        }else{
            # call access denied function
            $this->render_403_template();
        }
    }

    
    public function generate_track($artist_id){
        $condition = array('artist_id' => $artist_id);
        $list = $this->track->get_track_information($condition);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record) {
            $no++;
            $row = array();
            $row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'. $record->track_id.'">
            </div>';
            $row[] = $no;
             if ($record->photo == "") {
                $row[] = '<img src="'.base_url('uploads/users/nophoto.jpg').'" style="height:20px; width:20px" class="" onclick="view_photo('."'".$record->track_id."'".')" />
                ';
            }else{
                $row[] = '<img src="'.base_url('uploads/tracks/'.$record->photo).'" style="height:50px; width:auto" onclick="view_photo('."'".$record->track_id."'".')" />
                ';
            }
            $row[] = $record->track_title;
            $row[] = $record->release_year;
            $row[] = '<div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                            data-toggle="dropdown">Actions<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="text-success" href="javascript:void(0)" 
                                onclick="view_track(' . "'" . $record->track_id . "'" . ')">
                                <i class="fa fa-eye"></i>View track</a>
                            </li>
                            <li><a class="text-primary" href="javascript:void(0)" 
                                onclick="update_track(' . "'" . $record->track_id . "'" . ')">
                                <i class="fa fa-edit"></i>Edit track</a>
                            </li>
                            <li><a class="text-danger" href="javascript:void(0)" 
                                onclick="delete_track(' . "'" . $record->track_id . "'" . ',' . "'" . $record->track_title . "'" . ')">
                                <i class="fa fa-trash"></i> Delete track</a>
                            </li>
                        </ul>
                    </div>
                ';
            //add html for action
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal"    => $this->track->count_all_track($condition),
            "recordsFiltered" => $this->track->count_filtered_track($condition),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_records_by_techer_id($track_id){
        $data = $this->track->get_by_track_id($track_id);
        echo json_encode($data);
    }

    public function add_new_track(){
        $this->validate_track_records();
        $track_title  = $this->input->post('track_title');

        $data = array(
            'genre_id' => $this->input->post('genre_id'),
            'artist_id' => $this->input->post('artist_id'),
            'track_title'      => $this->input->post('track_title'),
            'release_year'      => $this->input->post('release_year'),
            'created_date' => date('h:i:sa')
        );
        $track_titleexist = $this->track->check_track_track_title_exit($track_title);
       
        # check user permission
        if ($this->userdata['role'] == 5 || $this->userdata['role'] == 1) {
            # check if track track_title, contact & email already added...
            if($track_titleexist > 0){
                echo json_encode("track_track_title_exist");
            } else{
                # check if the track photo is being uploaded
                if (!empty($_FILES['photo']['name'])) {
                    $upload = $this->do_upload_track_photo();
                    $data['photo'] = $upload;
                }
                # check if the track photo is being uploaded
                if (!empty($_FILES['track']['name'])) {
                    $upload = $this->do_upload_track_audio();
                    $data['track'] = $upload;
                }
                $insert = $this->track->save_track_record($data);
                
                echo json_encode(array("status" => TRUE));
            } 
        }else{
            echo json_encode("access_denied");
        }
    }

    public function update_track_records(){
        $this->validate_track_records();
        $data = array(
            'genre_id' => $this->input->post('genre_id'),
            'artist_id' => $this->input->post('artist_id'),
            'track_title'      => $this->input->post('track_title'),
            'release_year'      => $this->input->post('release_year'),
            'created_date' => date('h:i:sa')
        );
        $id = $this->input->post('trackid');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            if (!empty($_FILES['photo']['name'])) {
                $upload = $this->do_upload_track_photo();
                # Removing the existing track profile picture
                $trackRow = $this->track->get_by_track_id($this->input->post('trackid'));
                if(file_exists('uploads/tracks/'.$trackRow->photo) && $trackRow->photo){
                    unlink('uploads/tracks/'.$trackRow->photo);
                }
                $data['photo'] = $upload;
            }if (!empty($_FILES['track']['name'])) {
                $upload = $this->do_upload_track_audio();
                # Removing the existing track
                $trackRow = $this->track->get_by_track_id($this->input->post('trackid'));
                if(file_exists('uploads/tracks/audio/'.$trackRow->track) && $trackRow->track){
                    unlink('uploads/tracks/audio/'.$trackRow->track);
                }
                $data['track'] = $upload;
            }
            $this->track->update_track_record($id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }
    public function delete_track_record($track_id){
        # check track permission
        if ($this->userdata['role'] == 5 || $this->userdata['role'] == 1) {
            # Removing the existing track picture
            $trackRow = $this->track->get_tracks_info_by_track_id($track_id);
            if(file_exists('uploads/tracks/'.$trackRow->photo) && $trackRow->photo){
                unlink('uploads/tracks/'.$trackRow->photo);
            }
            if(file_exists('uploads/tracks/audio/'.$trackRow->track) && $trackRow->track){
                unlink('uploads/tracks/audio/'.$trackRow->track);
            }
            # delete track information from track information
            $this->track->delete_by_track_id($track_id);
            # delete track's information from user table
            $this->user->delete_track_by_track_id($track_id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_track_delete(){
        $selectedtrackID = $this->input->post('id');
        # check user permission
        if ($this->userdata['role'] == 5 || $this->userdata['role'] == 1) {
            foreach ($selectedtrackID as $trackid) {
                # Removing the existing track picture
                $trackRow = $this->track->get_tracks_info_by_track_id($trackid);
                if(file_exists('uploads/tracks/'.$trackRow->photo) && $trackRow->photo){
                    unlink('uploads/tracks/'.$trackRow->photo);
                }
                if(file_exists('uploads/tracks/audio/'.$trackRow->track) && $trackRow->track){
                    unlink('uploads/tracks/audio/'.$trackRow->track);
                }
                # delete track information from track table
                $this->track->delete_by_track_id($trackid);
                # delete track's information from user table
                $this->user->delete_track_by_track_id($track_id);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }
    
    private function do_upload_track_photo() {
        $track_title = $this->input->post('track_title');
        $config['upload_path'] = './uploads/tracks/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']             = 8600; //set max size allowed in Kilobyte
        $config['max_width']            = 640; // set max width image allowed
        $config['max_height']           = 740; // set max height allowed
        //$config['file_name'] = round(microtime(true) * 1000);
        $config['file_name'] = $track_title; 
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('photo')) { //upload and validate
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload Error: ' . $this->upload->display_errors('', ''); 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function do_upload_track_audio() {
        $track_title = $this->input->post('track_title');
        $config['upload_path'] = './uploads/tracks/audio/';
        $config['allowed_types'] = 'mp3|mp4';
        $config['file_name'] = $track_title; 
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('track')) { //upload and validate
            $data['inputerror'][] = 'track';
            $data['error_string'][] = 'Upload Error: ' . $this->upload->display_errors('', ''); 
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function validate_track_records(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('track_title') == '') {
            $data['inputerror'][] = 'track_title';
            $data['error_string'][] = 'track_title is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}