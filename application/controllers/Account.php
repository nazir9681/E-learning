<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

 class Account extends CI_controller
 {
 
	public function __construct()
    {
      parent::__construct();
      
	  $this->load->model('AccountModel');
    }
   public function index()
   {
		if($this->session->userdata('admin_id')){ 
			redirect('admin/index');
		}
   	  $this->load->view('admin/admin_login');
   }
   public function login()
   {
   
		
      $this->load->library('form_validation');
      $this->form_validation->set_rules('uname','User name','required');
      $this->form_validation->set_rules('pass','Password','required');
      if($this->form_validation->run())
      {
        $uname=$this->input->post('uname');
        $pass=$this->input->post('pass');
        $id=$this->AccountModel->admin_login($uname,$pass);
        if($id)
        {
			$this->load->library('session');
			$this->session->set_userdata('admin_id',$id);
		   
			return redirect('admin/index');
        }else{
          echo "<script> alert('Incorrect password....!');</script>";
          $this->load->view('admin/admin_login');
        }
        
      }else{
        //echo validation_errors();
        $this->load->view('admin/admin_login');
      }
   }
  
}