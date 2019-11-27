<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //system/helpers/url_helper.php
        $this->load->helper('url_helper');
        $this->load->model('PostModel');
        session_start();
    }

    public function index(){
        if ( ! file_exists(APPPATH.'views/admin/index.php'))
        {
            show_404();
        }
        if($this->isAdminLogged()) {
            $data = [];
            $data['adminEmail'] = $_SESSION['admin_email'];
            $blogData = $this->PostModel->getPost();
            $data['blogList'] = $blogData;
            $this->load->view('admin/index', $data);
        }else{
            redirect('admin/login');
        }
    }

    public function login()
    {
        if ( ! file_exists(APPPATH.'views/admin/login.php'))
        {
            show_404();
        }
        $this->load->view('admin/login');
    }

    public function logout()
    {
        $this->clearAdminSession();
        redirect('admin/login');
    }

    public function loginPost()
    {
        $adminEmail = 'admin';
        $adminPassword = 'admin123';
        if($_POST) {
            $email = $_POST['email'];
            $password = $_POST['pass'];
            if (($email == $adminEmail) && ($password == $adminPassword)) {
                //dang nhap thanh cong, luu thong tin vao session
                $this->saveAdminSession($adminEmail);
                redirect('admin');
            } else {
                $data['error'] = true;
                $this->load->view('admin/login', $data);
            }
        }else{
            //dont have post data
            $data['error'] = true;
            $this->load->view('admin/login', $data);
        }
    }

    public function createBlog(){
        if ( ! file_exists(APPPATH.'views/admin/create_blog.php'))
        {
            show_404();
        }
        if($this->isAdminLogged()) {
            $this->load->view('admin/create_blog');
        }else{
            redirect('admin/login');
        }
    }

    public function changeBlog(){
    	if( ! file_exists(APPPATH.'views/admin/change_blog.php'))
		{
			show_404();
		}
    	if($this->isAdminLogged()){
    		$this->load->view('admin/change_blog');
		}
    	else{
    		redirect('admin/login');
		}
	}

	public function changeBlogPost(){
    	if($this->isAdminLogged()){
    			if ($this->PostModel->changePost($_POST)){
					redirect('admin');
				}
				else
				{
					redirect('admin/changeBlog');
				}
    	}
    	else {
			redirect('admin/login');
		}
    }

    public function deletePost($postId){
        if($this->isAdminLogged()) {
            $this->PostModel->deletePost($postId);
            redirect('admin');
        }else{
            redirect('admin/login');
        }
    }

    public function createBlogPost(){
        if($this->isAdminLogged()) {
            if(!$this->validatePostData($_POST)){
                //post data is not correct
                redirect('admin/createBlog');
                return;
            }
            if($this->PostModel->createPost($_POST)){
                //insert data success
                redirect('admin');
            }else{
                //in case insert blog post error
                redirect('admin/createBlog');
            }

        }else{
            redirect('admin/login');
        }
    }

    private function validatePostData($data){
        if(!$data['title'] || !$data['content']){
            return false;
        }else{
            return true;
        }
    }

    private function saveAdminSession($adminEmail){
        $_SESSION['is_admin_logged'] = true;
        $_SESSION['admin_email'] = $adminEmail;

    }

    private function clearAdminSession(){
        unset($_SESSION['is_admin_logged']);
        unset($_SESSION['admin_email']);
    }

    private function isAdminLogged(){
        if ( isset($_SESSION['is_admin_logged']) && ($_SESSION['is_admin_logged'] == true) ){
            return true;
        }else{
            return false;
        }
    }
}
