<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/roles/roles_model','role');
    }

    public function blog(){
    $data['title'] = $this->sspname.'Blogs';
    # check user permission
    if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
        # access granted
        $this->render_template('admin/blog/index',$data);
    }else{
        # call access denied function
        $this->render_403_template();
    }
  }

    public function generate_blog(){
        $list = $this->blog->get_blogs_information();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record) {
            $no++;
            $row = array();
             $row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'
                    .$record->blog_id.'">
                </div>';
            $row[] = $no;
            $row[] = $record->blog_title;
            $row[] = $record->created_at;
            $row[] = $record->created_by;
            $row[] = $record->updated_at;
            $row[] = '
                <div class="text-center">
                    <a class="btn btn-primary btn-sm" href="'.base_url('admin/blogs/update/'.$record->blog_id.'/'.url_title(strtolower($record->blog_title), 'dash', true)).'"><i class="fa fa-edit"></i> Update</a>
                </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->blog->count_all_blogs(),
            "recordsFiltered" => $this->blog->count_filtered_blogs(),
            "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }

    public function get_records_by_display_id($id){
        $data = $this->display->get_display_by_id($id);
        echo json_encode($data);
	}


    public function create(){
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # access granted
            $this->render_template('admin/modules/blog/create');
        }else{
            # call access denied function
            $this->render_403_template();
        }
    }

    public function create_new_blog(){
        $data = array('blog_title' => $this->input->post('subject'),
            'blog_content' => $this->input->post('content'),
            'created_at' => date('Y-m-d h:i:s A'),
            'created_by' => $this->input->post('created_by') 
        );
        # get role information
        // $roleRow = $this->role->get_by_role_id($role);
        // $roleName = $roleRow->name;
        // $role_slug_name = url_title(strtolower($roleName), 'dash', true);
        #check for existence
        $check = array('blog_title' => $this->input->post('subject'));
        $checkexistName    = $this->blog->check_blog_name($check);
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # check if topic name already added
            if($checkexistName > 0){
               # blog title name already exist
                $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
                    Blog Title Name Exist: The New Added Blog Title Name already Exist!',2);
                redirect(base_url('admin/blogs/create'));
            }else{
                # check if the group image is uploaded
                if (!empty($_FILES['file']['name'])) {
                    $blog_id = 0;
                    $upload = $this->do_upload_blog_file($blog_id);
                    $data['blog_file'] = $upload;
                    $insert = $this->blog->save_blog_record($data);
                    # display message success
                    $this->session->set_flashdata('success', '<i class="fa fa-check"></i>  Blog Created: New Created Has Been Created Successfully!',2);
                    redirect(base_url('admin/blogs/create'));
                }else{
                    # blog image or video is required
                    $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
                    Upload Error: Please, the Blog Image is required!',2);
                    redirect(base_url('admin/blogs/create'));
                }  
            } 
        }else{
            # access denied
            $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
                You are not Authorized to create any New Blog!',2);
            redirect(base_url('admin/blogs/create'));
        } 
    }

    public function update($blog_id){
        # get blog information
        $blogRow = $this->blog->get_record_by_blog_id($blog_id);
        $data['title'] = $this->sspname.''.' Blogs Information';
        $data['blog_id'] = $blog_id;
        $data['blogRow'] = $blogRow;
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # access granted
            $this->render_template('admin/modules/blog/update', $data);
        }else{
            # call access denied function
            $this->render_403_template();
        }
    }

    public function update_blog($blog_id){
        $data = array('blog_title' => $this->input->post('subject'),
            'blog_content' => $this->input->post('content'),
            'updated_at' => date('Y-m-d h:i:s A'),
            'created_by' => $this->input->post('created_by') 
        );
        # get blog information
        $blogRow = $this->blog->get_record_by_blog_id($blog_id);
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5){
            # check if the group image is uploaded
            if (!empty($_FILES['file']['name'])) {
                $upload = $this->do_upload_blog_file($blog_id);
                # Removing the existing blog image
                $blogRow = $this->blog->get_record_by_blog_id($blog_id);
                if(file_exists('uploads/blogs/'.$blogRow->blog_file) && $blogRow->blog_file){
                    unlink('uploads/blogs/'.$blogRow->blog_file);
                }
                $data['blog_file'] = $upload;
            }
            # update blog information
            $this->blog->update_blogs_record($blog_id, $data);
            # display message success
            $this->session->set_flashdata('success', '<i class="fa fa-check"></i>  Blog Updated: Blog Has Been Updated Successfully!',2);
            redirect(base_url('admin/blogs/update/'.$blog_id));
        }else{
            # access denied
            $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
                Access Denied: You are not Authorized to Update any Blog!',2);
            redirect(base_url('admin/blogs/update/'.$blog_id));
        } 
    }

    private function do_upload_blog_file($blog_id) {
        # get blog information
        $blogRow = $this->blog->get_record_by_blog_id($blog_id);
        $config['upload_path'] = './uploads/blogs/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';
        $config['max_size']             = 8000; //set max size allowed in Kilobyte
        //$config['max_width']            = 800; // set max width image allowed
        //$config['max_height']           = 600; // set max height allowed
        $config['file_name'] = round(microtime(true) * 1000);
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) { //upload and validate
            # check status
            if ($blog_id == 0) {
                $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
               Upload Error: ' . $this->upload->display_errors('', '').'!',2);
                redirect(base_url('admin/blogs/create'));
            }else{
                # redirect to the blog update page
                $this->session->set_flashdata('error', '<i class="fa fa-exclamation-triangle"></i>  
               Upload Error: ' . $this->upload->display_errors('', '').'!',2);
                redirect(base_url('admin/blogs/update'));
            }
        }
        return $this->upload->data('file_name');
    }

    public function bulk_blogs_delete(){
        $selectedBlogsID = $this->input->post('blog_id');
        # check user permission
        if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) {
            foreach ($selectedBlogsID as $blog_id) {
                # Removing the existing blog image
                $blogRow = $this->blog->get_record_by_blog_id($blog_id);
                if(file_exists('uploads/blogs/'.$blogRow->blog_file) && $blogRow->blog_file){
                    unlink('uploads/blogs/'.$blogRow->blog_file);
                }
                # perform blog delete
                $this->blog->delete_by_blog_id($blog_id);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode("access_denied");
        }
    }
    

}