<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Secton Information Controller
 */
class Genre extends Admin_Controller{
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['title'] = $this->sspname.'Genre Information';
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # access granted
            $this->render_template('admin/genre/genre', $data);
        }else{
            # call access denied function
            $this->render_403_template();
        }
    }


    public function generate_genre(){
        $list = $this->genre->get_genre_information();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $record->genre_name;
            $row[] = ucwords($record->genre_type);
            # check whether the genre type is equal to system
            if (strtolower($record->genre_type) == 'system') {
                # hide delete button
                $row[] = '
                    <div class="dropdown text-center">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                            data-toggle="dropdown">Actions<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="text-success" href="'.base_url('admin/genre/artist/'.$record->genre_id.'/'.url_title(strtolower($record->genre_name), 'dash', true)).'"><i class="fa fa-plus"></i> Artist</a></li>
                            <li><a class="text-success" href="javascript:void(0)" 
                                onclick="view_genre(' . "'" . $record->genre_id . "'" . ')">
                                <i class="fa fa-eye"></i>View genre</a>
                            </li>
                            <li><a class="text-primary" href="javascript:void(0)" 
                                onclick="update_genre(' . "'" . $record->genre_id . "'" . ')">
                                <i class="fa fa-edit"></i>Edit genre</a>
                            </li>
                        </ul>
                    </div>
                ';
            }else{
                # show delete button
                $row[] = '
                    <div class="dropdown text-center">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                            data-toggle="dropdown">Actions<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="text-success" href="'.base_url('admin/genre/artist/'.$record->genre_id.'/'.url_title(strtolower($record->genre_name), 'dash', true)).'"><i class="fa fa-plus"></i> Artist</a></li>
                            <li><a class="text-success" href="javascript:void(0)" 
                                onclick="view_genre(' . "'" . $record->genre_id . "'" . ')">
                                <i class="fa fa-eye"></i>View genre</a>
                            </li>
                            <li><a class="text-primary" href="javascript:void(0)" 
                                onclick="update_genre(' . "'" . $record->genre_id . "'" . ')">
                                <i class="fa fa-edit"></i>Edit genre</a>
                            </li>
                            <li><a class="text-danger" href="javascript:void(0)" 
                                onclick="delete_genre(' . "'" . $record->genre_id . "'" . ',' . "'" . $record->genre_name . "'" . ')">
                                <i class="fa fa-trash"></i> Delete genre</a>
                            </li>
                        </ul>
                    </div>
                ';
            }
            //add html for action
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal"    => $this->genre->count_all_genre(),
            "recordsFiltered" => $this->genre->count_filtered_genre(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_records_by_genre_id($genre_id){
        $data = $this->genre->get_genre_by_id($genre_id);
        echo json_encode($data);
    }

    public function add_new_genre(){
        $this->validate_genre_records();
        $genre_name = $this->input->post('genre_name');

        $data = array(
            'genre_name' => $this->input->post('genre_name'),
            'created_at' => date('Y-m-d')
        );
        $genreNameexist  = $this->genre->check_genre_name($genre_name);
        # check user permission
        if ($this->userdata['role'] == 5 || $this->userdata['role'] == 1) {
            # check if genre name d already added...
            if($genreNameexist > 0){
                echo json_encode("genre_name_exist");
            }else{

                $insert = $this->genre->save_genre_record($data);
                echo json_encode(array("status" => TRUE));
            } 
        }else{
            echo json_encode("access_denied");
        }
    }

    public function update_genre_records(){
        $this->validate_genre_records();
        $data = array(
            'genre_name' => $this->input->post('genre_name')
        );
        $genre_id =  $this->input->post('genreid');
        # check user permission
        if ($this->userdata['role'] == 5 || $this->userdata['role'] == 1) {
            $this->genre->update_genre_record($genre_id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function delete_genre_record($genre_id){
        # check user permission
        if ($this->userdata['role'] == 5 || $this->userdata['role'] == 1) {
            $this->genre->delete_by_genre_id($genre_id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_genre_delete(){
        $selectedgenreID = $this->input->post('genre_id');
        # check user permission
        if ($this->userdata['role'] == 5 || $this->userdata['role'] == 1) {
            foreach ($selectedgenreID  as $genre_id) {
                # perform class delete...
                $this->genre->delete_by_genre_id($genre_id);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    private function validate_genre_records(){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('genre_name') == '') {
            $data['inputerror'][] = 'genre_name';
            $data['error_string'][] = 'genre name is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }


    /**************************************************************************************************
    *
    *                                   ARTIST INFORMATION
    *
    **************************************************************************************************/

    public function artist($genre_id, $genre_name_slug){
        $genreRow  = $this->genre->get_genre_by_id($genre_id);
        $genreName = $genreRow->genre_name;
        $data['title']       = $this->sspname.''.$genreName.' artists Information'; 
        $data['roleResults'] = $this->role->get_roles();
        $data['genre_id']  = $genre_id;
        $data['genre_name']= $genreName;
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # access granted
            $this->render_template('admin/genre/artist', $data);
        }else{
            # call access denied function
            $this->render_403_template();
        }
    }

    public function generate_artist($genre_id){
        $condition = array('genre_id' => $genre_id);
        $list = $this->artist->get_artist_information($condition);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record) {
            $no++;
            $row = array();
             $row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'
                    .$record->artist_id.'">
                </div>';
            $row[] = $no;
            $row[] = $record->artist_name;
            $row[] = $record->email;
            $row[] = $record->contact;
            $row[] = $record->address;
            $row[] = '
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Actions<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="text-success" href="'.base_url('admin/artist/track/track/'.$record->artist_id.'/'.url_title(strtolower($record->artist_name), 'dash', true)).'"><i class="fa fa-plus"></i>Track</a></li>
                        <li><a class="text-success" href=""><i class="fa fa-plus"></i>Album</a></li>
                        <li><a class="text-success" href="javascript:void(0)" 
                        onclick="view_artist(' . "'" . $record->artist_id . "'" . ')">
                        <i class="fa fa-eye"></i>View artist</a></li>
                        <li><a class="text-primary" href="javascript:void(0)" 
                        onclick="update_artist(' . "'" . $record->artist_id . "'" . ')">
                        <i class="fa fa-edit"></i>Edit artist</a></li>
                        <li><a class="text-danger" href="javascript:void(0)" 
                        onclick="delete_class(' . "'" . $record->artist_id . "'" . ',' . "'" . $record->artist_name . "'" . ')">
                        <i class="fa fa-trash"></i> Delete artist</a></li>
                    </ul>
                </div>
            ';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal"    => $this->artist->count_all_artist($condition),
            "recordsFiltered" => $this->artist->count_filtered_artist($condition),
            "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }

    public function add_new_artist(){
        $this->validate_artist_records();
        $genre_id  = $this->input->post('genre_id');
        $artist_name = $this->input->post('artist_name');
        $artist_reg_no = $this->artist->generate_artist_reg_no();
        $data = array(
            'genre_id'  => $genre_id,
            'reg_no' => $artist_reg_no,
            'artist_name' => $this->input->post('artist_name'),
            'address'     => $this->input->post('address'),
            'email'       => $this->input->post('email'),
            'gender'     => $this->input->post('gender'),
            'dob'     => $this->input->post('dob'),
            'biography'     => $this->input->post('biography'),
            'designation'       => $this->input->post('designation'),
            'nationality'       => $this->input->post('nationality'),
            'gender'     => $this->input->post('gender'),
            'contact'       => $this->input->post('contact'),
            'created_date'  => date('Y-m-d')
        );
        //check for existence
        $artistName = $this->artist->check_artist_name($artist_name);
        //check for permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            if ($artistName > 0) {
                echo json_encode('artist_name_exist');
            }else {
                # check if the teacher photo is being uploaded
                if (!empty($_FILES['photo']['name'])) {
                    $upload = $this->do_upload_artist_photo();
                    $data['photo'] = $upload;
                }
                
                $insert = $this->artist->save_artist_record($data);
                echo json_encode(array("status" => TRUE));
            }
        }else{
            echo json_encode("access_denied");
        } 
    }

    public function get_records_by_artist_id($artist_id){
        $data = $this->artist->get_info_by_artist_id($artist_id);
        echo json_encode($data);
    }

    public function update_artist_records(){
        $this->validate_artist_records();
        $data = array(
            'artist_name' => $this->input->post('artist_name'),
            'address'     => $this->input->post('address'),
            'email'       => $this->input->post('email'),
            'gender'     => $this->input->post('gender'),
            'biography'     => $this->input->post('biography'),
            'dob'     => $this->input->post('dob'),
            'designation'       => $this->input->post('designation'),
            'nationality'       => $this->input->post('nationality'),
            'gender'     => $this->input->post('gender'),
            'contact'       => $this->input->post('contact'),
            'created_date'  => date('Y-m-d')
        );
        $artist_id = $this->input->post('artistid');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
            if (!empty($_FILES['photo']['name'])) {
                $upload = $this->do_upload_artist_photo();
                # Removing the existing artist profile picture
                $artistRow = $this->artist->get_by_artist_id($this->input->post('artistid'));
                if(file_exists('uploads/artists/'.$artistRow->photo) && $artistRow->photo){
                    unlink('uploads/artists/'.$artistRow->photo);
                }
                $data['photo'] = $upload;
            }
            $this->artist->update_artist_record($artist_id, $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function delete_artist_record($artist_id){
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
            # delete subtopic info
            $this->artist->delete_by_artist_id($artist_id);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }

    public function bulk_artist_delete(){
        $selectedartistID = $this->input->post('artist_id');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
            foreach ($selectedartistID as $artist_id) {
               # perform class delete...
                $this->artist->delete_by_artist_id($artist_id);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }


    private function do_upload_artist_photo() {
        $artistName = $this->input->post('artist_name');
        $config['upload_path'] = './uploads/artists/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']             = 8600; //set max size allowed in Kilobyte
        $config['max_width']            = 640; // set max width image allowed
        $config['max_height']           = 740; // set max height allowed
        //$config['file_name'] = round(microtime(true) * 1000);
        $config['file_name'] = $artistName; 
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
    private function validate_artist_records(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if ($this->input->post('artist_name') == '') {
            $data['inputerror'][] = 'artist_name';
            $data['error_string'][] = 'artist Name is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'artist Email Address is required';
            $data['status'] = FALSE;
        }else{
            // check if e-mail address is well-formed
            if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
                $data['inputerror'][] = 'email';
                $data['error_string'][] = 'Email is Invalid';
                $data['status'] = FALSE;
            }
        }
        if ($this->input->post('contact') == '') {
            $data['inputerror'][] = 'contact';
            $data['error_string'][] = 'contact is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('address') == '') {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }
        
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}