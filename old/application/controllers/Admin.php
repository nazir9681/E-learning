<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
	public function __construct()
    {
      parent::__construct();
      //$this->logged_in();
	  $this->load->model('AdminModel');
    }
	
	public function index()
	{
		
		$this->load->view('admin/index');
			
	}
	public function teachers()
	{
		$teachersData = $this->AdminModel->teacherData();
		$this->load->view('admin/teachers',['teacherList'=>$teachersData]);
			
	}
	public function teacherModify($type,$id=0)
	{
		//$teachersData = $this->AdminModel->admin_login($uname,$pass);
		$teachersData = '';
		if($type=='add'){
		
			if(!empty($this->input->post())){
				
				if(empty($_FILES['teacher_profile']['name']))
					{
						//echo 'invalid';
						$details = $this->input->post();
						$details['teacher_profile'] = '';
						$details['teacher_unique_id'] = 'OT'.substr(str_shuffle('98765432101234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'),0,8);
						$data = $this->AdminModel->teacherModify($type,$id,$details);
						
						$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
						redirect('admin/teachers');
					}
					else
					{
							$allow_ext = array('png','jpg','jpeg','JPEG');
							$file_ext = image_extension($_FILES['teacher_profile']['name']);
							if(in_array($file_ext,$allow_ext))
							{
								$file = create_image_unique($_FILES['teacher_profile']['name']);
								$file_name = 'uploads/teachers/'.$file;
								$tmp_name = $_FILES['teacher_profile']['tmp_name'];
								$path = 'uploads/teachers/'.$file;
								move_uploaded_file($tmp_name,$path);
								$details = $this->input->post();
								$details['teacher_profile'] = $file_name;
								$details['teacher_unique_id'] = 'OT'.substr(str_shuffle('98765432101234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'),0,8);
								$data = $this->AdminModel->teacherModify($type,$id,$details);
								$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
								redirect('admin/teachers');
							}
							else
							{
								$this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Added....!</div>');
								redirect('admin/teachers');
							}
			   }
			}
			else
			{
				
				$this->load->view('admin/teacher_modify',['type'=>$type,'id'=>$id]);
			
			}

			
	   }
	   elseif($type=="edit"){
				
				$info = $this->AdminModel->teacherInfo($id);
				if(!empty($this->input->post())){
				
						if(empty($_FILES['teacher_profile']['name']))
						{
							//echo 'invalid'
							
							$details = $this->input->post();
							if(empty($details['teacher_password'])){
									
								$details['teacher_password'] = $info->teacher_password;
							}
							$details['teacher_profile'] = $info->teacher_profile;
							$data = $this->AdminModel->teacherModify($type,$id,$details);
							$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
							redirect('admin/teachers');
						}
						else
						{
								$allow_ext = array('png','jpg','jpeg','JPEG');
								$file_ext = image_extension($_FILES['teacher_profile']['name']);
								if(in_array($file_ext,$allow_ext))
								{
									$file = create_image_unique($_FILES['teacher_profile']['name']);
									$file_name = 'uploads/teachers/'.$file;
									
									$tmp_name = $_FILES['teacher_profile']['tmp_name'];
									$path = 'uploads/teachers/'.$file;
									move_uploaded_file($tmp_name,$path);
									$details = $this->input->post();
									
									if(empty($details['teacher_password'])){
									
										$details['teacher_password'] = $info->teacher_password;
									}
									
									$details['teacher_profile'] = $file_name;
									$data = $this->AdminModel->teacherModify($type,$id,$details);
									$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
									redirect('admin/teachers');
								}
								else
								{
									$this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Added....!</div>');
									redirect('admin/teachers');
									
								}
						}
				}
				else
				{
				
					$teachersData = $this->AdminModel->teacherInfo($id);
					$this->load->view('admin/teacher_modify',['teacherList'=>$teachersData,'type'=>$type,'id'=>$id]);
				}
	   
	   }
		
			
	}
	
}	

?>