<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
    }

    public function index()
    {
        if ( ! file_exists(APPPATH.'views/blog/index.php'))
        {
            show_404();
        }
		$this->load->model('PostModel');
        $datablog=$this->PostModel->getPost();
        $numberrecord=$this->PostModel->countrecord();
        $data=[];
        $data['datablog']=$datablog;
        $data['numberrecord']=$numberrecord;
        $this->load->view('templates/header');
        $this->load->view('blog/index',$data);
        $this->load->view('templates/footer');
    }

    public function view($postId = null)
    {
        if ( ! file_exists(APPPATH.'views/blog/view_post.php'))
        {
            show_404();
        }
		$this->load->model('PostModel');
		$datablog=$this->PostModel->getPost($postId);
        $data=[];
        $data['datablog']=$datablog;
        $this->load->view('templates/header');
        $this->load->view('blog/view_post',$data);
        $this->load->view('templates/footer');
    }

    public function aboutus(){
        if ( ! file_exists(APPPATH.'views/about_us.php'))
        {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('about_us');
        $this->load->view('templates/footer');
    }

}
