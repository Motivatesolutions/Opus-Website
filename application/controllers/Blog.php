<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PDN Website
 */
class Blog extends Client_Controller{
	
	public function __construct(){
		parent::__construct();
	}

    public function index(){
        $data['blogResult'] = $this->blog->generate_blog_info(3);
        $this->render_template('blog',$data);
       }

       public function single_blog($blog_id){
        $data['blogRow']=$this->blog->get_record_by_blog_id($blog_id);
        $data['blogResult'] = $this->blog->generate_blog_info(3);
        $this->load->view('blog-single',$data);
    }

	public function show_404(){
        $data['title']="404 - Page Not Found";
        $this->load->view('errors/404',$data);
    }
}