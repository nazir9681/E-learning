<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
	public function __construct()
    {
      parent::__construct();
      $this->logged_in();
	  $this->load->model('AdminModel');
	  $this->load->model('LearningApiModel','LearnApi');
    }
	
	private function logged_in()
    {
      if(!$this->session->userdata('admin_id')){ 
        redirect('account/index');
      }
    }
	public function admin_logout()
   {
      $this->session->unset_userdata('admin_id');
        redirect('account/index');
   }
	public function index()
	{
		$dataCount = $this->AdminModel->dashboardDataCount();
		$this->load->view('admin/index',['studentCount'=>$dataCount]);
			
	}
	public function teachers()
	{
             
		$teachersData = $this->AdminModel->teacherData();
		$this->load->view('admin/teachers',['teacherList'=>$teachersData]);
			
	}
	public function teacherModify($type,$id=0)
	{
		$teachersData = '';
		if($type=='add'){
		
			if(!empty($this->input->post())){
				
				if(empty($_FILES['teacher_profile']['name']))
					{
						//echo 'invalid';
						$details = $this->input->post();
						if ($details['teacher_prefernce']) {
							$teacher_prefernce = implode(",",$details['teacher_prefernce']);
						}
						else{
							$teacher_prefernce = '';	
						}
						$details['teacher_prefernce'] = $teacher_prefernce;
						$details['teacher_profile'] = '';
						$details['teacher_unique_id'] = 'OT'.substr(str_shuffle('98765432101234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'),0,8);
						$data = $this->AdminModel->teacherModify($type,$id,$details);
						
						$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
						redirect('admin/teachers');
					}
					else
					{
							$allow_ext = array('png','jpg','jpeg','JPEG','jfif');
							$file_ext = image_extension($_FILES['teacher_profile']['name']);
							if(in_array($file_ext,$allow_ext))
							{
								$file = create_image_unique($_FILES['teacher_profile']['name']);
								$file_name = 'uploads/teachers/'.$file;
								$tmp_name = $_FILES['teacher_profile']['tmp_name'];
								$path = 'uploads/teachers/'.$file;
								move_uploaded_file($tmp_name,$path);
								$details = $this->input->post();
								if ($details['teacher_prefernce']) {
									$teacher_prefernce = implode(",",$details['teacher_prefernce']);
								}
								else{
									$teacher_prefernce = '';	
								}
								$details['teacher_prefernce'] = $teacher_prefernce;
								$details['teacher_profile'] = $file_name;
								$details['teacher_unique_id'] = 'OT'.substr(str_shuffle('98765432101234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'),0,8);
								$data = $this->AdminModel->teacherModify($type,$id,$details);
							
								$teacher_name=$this->input->post('teacher_name');
								$this->FirebaseData($teacher_name);
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
				$data = $this->AdminModel->subjectData();
				$this->load->view('admin/teacher_modify',['type'=>$type,'id'=>$id, 'subject'=>$data]);
			
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
							if ($details['teacher_prefernce']) {
									$teacher_prefernce = implode(",",$details['teacher_prefernce']);
								}
							else{
									$teacher_prefernce = '';	
							}
							$details['teacher_prefernce'] = $teacher_prefernce;
							$details['teacher_profile'] = $info->teacher_profile;
							$data = $this->AdminModel->teacherModify($type,$id,$details);
							
							$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
							
							redirect('admin/teachers');
							
						}
						else
						{
								$allow_ext = array('png','jpg','jpeg','JPEG','jfif');
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
									if ($details['teacher_prefernce']) {
										$teacher_prefernce = implode(",",$details['teacher_prefernce']);
									}
									else{
										$teacher_prefernce = '';	
									}
									$details['teacher_prefernce'] = $teacher_prefernce;
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
					$data = $this->AdminModel->subjectData();
					$this->load->view('admin/teacher_modify',['teacherList'=>$teachersData,'type'=>$type,'id'=>$id, 'subject'=>$data]);
				}
	   
	   }	
			
	}

	public function studentModify($type,$id=0)
	{
		$studentsData = '';
		if($type=='add'){
		
			if(!empty($this->input->post())){
				
				if(empty($_FILES['student_profile']['name']))
					{
						//echo 'invalid';
						$details = $this->input->post();
						$details['student_profile'] = '';
						$details['student_unique_id'] = 'OS'.substr(str_shuffle('98765432101234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'),0,8);
						$data = $this->AdminModel->studentModify($type,$id,$details);
						
						$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
						redirect('admin/students');
					}
					else
					{
							$allow_ext = array('png','jpg','jpeg','JPEG');
							$file_ext = image_extension($_FILES['student_profile']['name']);
							if(in_array($file_ext,$allow_ext))
							{
								$file = create_image_unique($_FILES['student_profile']['name']);
								$file_name = 'uploads/students/'.$file;
								$tmp_name = $_FILES['student_profile']['tmp_name'];
								$path = 'uploads/students/'.$file;
								move_uploaded_file($tmp_name,$path);
								$details = $this->input->post();
								$details['student_profile'] = $file_name;
								$details['student_unique_id'] = 'OS'.substr(str_shuffle('98765432101234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'),0,8);
								$data = $this->AdminModel->studentModify($type,$id,$details);
								$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
								redirect('admin/students');
							}
							else
							{
								$this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Added....!</div>');
								redirect('admin/students');
							}
			   }
			}
			else
			{
				$student_course = $this->AdminModel->courseData();
				$this->load->view('admin/student_modify',['type'=>$type,'id'=>$id,'student_course'=>$student_course]);
			
			}			
	   }
	   elseif($type=="edit"){
				
				$info = $this->AdminModel->studentInfo($id);
				if(!empty($this->input->post())){
				
						if(empty($_FILES['student_profile']['name']))
						{
							//echo 'invalid'
							
							$details = $this->input->post();
							if(empty($details['student_password'])){
									
								$details['student_password'] = $info->student_password;
							}
							$details['student_profile'] = $info->student_profile;
							$data = $this->AdminModel->studentModify($type,$id,$details);
							$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
							redirect('admin/students');
						}
						else
						{
								$allow_ext = array('png','jpg','jpeg','JPEG');
								$file_ext = image_extension($_FILES['student_profile']['name']);
								if(in_array($file_ext,$allow_ext))
								{
									$file = create_image_unique($_FILES['student_profile']['name']);
									$file_name = 'uploads/students/'.$file;
									
									$tmp_name = $_FILES['student_profile']['tmp_name'];
									$path = 'uploads/students/'.$file;
									move_uploaded_file($tmp_name,$path);
									$details = $this->input->post();
									
									if(empty($details['student_password'])){
									
										$details['student_password'] = $info->teacher_password;
									}
									
									$details['student_profile'] = $file_name;
									$data = $this->AdminModel->studentModify($type,$id,$details);
									$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
									redirect('admin/students');
								}
								else
								{
									$this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Added....!</div>');
									redirect('admin/students');
									
								}
						}
				}
				else
				{
					$student_course = $this->AdminModel->courseData();
					$studentsData = $this->AdminModel->studentInfo($id);
					$this->load->view('admin/student_modify',['studentList'=>$studentsData,'type'=>$type,'id'=>$id,'student_course'=>$student_course]);
				}
	   
	   }	
			
	}

	public function students()
	{
		$studentsData = $this->AdminModel->studentData();
		$this->load->view('admin/students',['studentList'=>$studentsData]);
			
	}

	public function courseModify($type,$id=0)
      {
        $courseData = '';
        if($type=='add'){
        
          if(!empty($this->input->post())){
            
            if(empty($_FILES['course_image']['name']))
            {
                    $details = $this->input->post();
                    if ($details['course_type']) {
                        $course_type = implode(",",$details['course_type']);
                      }
                      else{
                        $course_type = '';  
                      }
                      $details['course_type'] = $course_type;
                    
                    
                    $data = $this->AdminModel->courseModify($type,$id,$details);
                    $course_name=$this->input->post('course_name');
                    //$this->FirebaseData($course_name);
                    $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
                    redirect('admin/courses');
                    }
                else{
                    $allow_ext = array('png','jpg','jpeg','JPEG','jfif');
                    $file_ext = image_extension($_FILES['course_image']['name']);
                    if(in_array($file_ext,$allow_ext))
                    {
                        
                      
                        $file = create_image_unique($_FILES['course_image']['name']);
                        $file_name = 'uploads/courses/'.$file;
                        
                        $tmp_name = $_FILES['course_image']['tmp_name'];
                        $path = 'uploads/courses/'.$file;
                        move_uploaded_file($tmp_name,$path);
                        $details = $this->input->post();
                        if ($details['course_type']) {
                        $course_type = implode(",",$details['course_type']);
                        }
                        else{
                        $course_type = '';  
                        }
                        $details['course_type'] = $course_type;
                        
                        
                        $details['course_image'] = $file_name;
                        $data = $this->AdminModel->courseModify($type,$id,$details);
                        $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
                        redirect('admin/courses');
                      }
                    else
                    {
                        $this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Added....!</div>');
                        redirect('admin/courses');
                        
                    }
                }
          }     
          else
          {
            $appointTeacher = $this->AdminModel->teacherData();
            $this->load->view('admin/modify_course',['type'=>$type,'id'=>$id,'appoint_teacher'=>$appointTeacher]);
          
          }     
         }
         elseif($type=="edit"){
            
            $info = $this->AdminModel->courseInfo($id);
            if(!empty($this->input->post())){
                    if(empty($_FILES['course_image']['name'])){
                      $details = $this->input->post();
                      if ($details['course_type']) {
                        $course_type = implode(",",$details['course_type']);
                      }
                      else{
                        $teacher_prefernce = '';  
                      }
                      $details['course_type'] = $course_type;
                      $details['course_image'] = $info->course_image;
                      $data = $this->AdminModel->courseModify($type,$id,$details);
                      $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
                      redirect('admin/courses');
                }
                else{
                        $allow_ext = array('png','jpg','jpeg','JPEG','jfif');
                        $file_ext = image_extension($_FILES['course_image']['name']);
                        if(in_array($file_ext,$allow_ext))
                        {
                            
                          
                            $file = create_image_unique($_FILES['course_image']['name']);
                            $file_name = 'uploads/courses/'.$file;
                            
                            $tmp_name = $_FILES['course_image']['tmp_name'];
                            $path = 'uploads/courses/'.$file;
                            move_uploaded_file($tmp_name,$path);
                            $details = $this->input->post();
                            if ($details['course_type']) {
                            $course_type = implode(",",$details['course_type']);
                            }
                            else{
                            $course_type = '';  
                            }
                            $details['course_type'] = $course_type;
                            $details['course_image'] = $file_name;
                            $data = $this->AdminModel->courseModify($type,$id,$details);
                            $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Updated....!</div>');
                            redirect('admin/courses');
                          }
                        else
                        {
                            $this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Updated....!</div>');
                            redirect('admin/courses');
                            
                        }
             
            }
         } else
            {
            
              $courseData = $this->AdminModel->courseInfo($id);
              $appointTeacher = $this->AdminModel->teacherData();
              $this->load->view('admin/modify_course',['courseList'=>$courseData,'type'=>$type,'id'=>$id,'appoint_teacher'=>$appointTeacher]);
            }
         
         }  
          
      }
	public function courses()
	{
		$courseData = $this->AdminModel->courseData();
		$this->load->view('admin/courses',['courseList'=>$courseData]);
			
	}
	public function subAdmin()
	{
		$subadminList = $this->AdminModel->subAdmin();
		$this->load->view('admin/sub_admin',['subadminList'=>$subadminList]);
			
	}
	
	public function subadminModify($type,$id=0)
	{
		if($type=='add'){
		
			if(!empty($this->input->post())){
				
				
								$details = $this->input->post();
								$data = $this->AdminModel->subadminModify($type,$id,$details);
								$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
								redirect('admin/subAdmin');
							}
					
			else
			{
				$this->load->view('admin/subadmin_modify',['type'=>$type,'id'=>$id]);
			
			}			
	   }
	   elseif($type=="edit"){
				
				$info = $this->AdminModel->adminInfo($id);
				if(!empty($this->input->post())){
				
						$details = $this->input->post();
						if(empty($details['admin_pass'])){
									
							$details['admin_pass'] = $info->admin_pass;
						}
						$data = $this->AdminModel->subadminModify($type,$id,$details);
						$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
						redirect('admin/subAdmin');
						}
				else
				{
				
					$adminData = $this->AdminModel->adminInfo($id);
					$this->load->view('admin/subadmin_modify',['type'=>$type,'id'=>$id,'adminData'=>$adminData]);
				}
	   
	   }	
			
	}
	public function order()
	{
	    $dataOrder = $this->AdminModel->orderData();
		$this->load->view('admin/order_section',['orderData'=>$dataOrder]);
			
	}
	public function offer()
	{
	    $data=$this->AdminModel->offerData();
		$this->load->view('admin/offer_section',['offerList'=>$data]);
			
	}
	public function isvalidate_offer(){
	        $allow_ext = array('png','jpg','jpeg','JPEG');
			$file_ext = image_extension($_FILES['offer_img']['name']);
			if(in_array($file_ext,$allow_ext))
			{
				$file = create_image_unique($_FILES['offer_img']['name']);
				$file_name = 'uploads/offer/'.$file;
				
				$tmp_name = $_FILES['offer_img']['tmp_name'];
				$path = 'uploads/offer/'.$file;
				move_uploaded_file($tmp_name,$path);
				$details = $this->input->post();
				
				
				$details['offer_img'] = $file_name;
				$data = $this->AdminModel->offer($details);
				$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
				redirect('admin/offer');
			}
 	}
	public function offer_status_update($type, $id){
	    $data = $this->AdminModel->offer_status_update($type, $id);
	    if($data){
	        $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Status Successfully Updated....!</div>');
				redirect('admin/offer');
	    }
	    else{
            $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something went wrong....!</div>');
				redirect('admin/offer');
	    }
	}
	public function isvalidate_offer_edit(){
	    $allow_ext = array('png','jpg','jpeg','JPEG');
		$file_ext = image_extension($_FILES['offer_img']['name']);
		if(in_array($file_ext,$allow_ext))
		{
			$file = create_image_unique($_FILES['offer_img']['name']);
			$file_name = 'uploads/offer/'.$file;
			
			$tmp_name = $_FILES['offer_img']['tmp_name'];
			$path = 'uploads/offer/'.$file;
			move_uploaded_file($tmp_name,$path);
			$details = $this->input->post();
			
			$data = $this->AdminModel->isvalidate_offer_edit($file_name);
			if($data){
			$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Offer Successfully Updated....!</div>');
			redirect('admin/offer');
			}
			else{
			    $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something went wrong....!</div>');
			redirect('admin/offer');
			}
		}
	}
	public function order_status_update($type, $id){
	    $data = $this->AdminModel->order_status_update($type, $id);
	    if($data){
	        $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Status Successfully Updated....!</div>');
				redirect('admin/order');
	    }
	    else{
            $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something went wrong....!</div>');
				redirect('admin/order');
	    }
	}
	public function orderDetailView($id){
	    $dataOrderView = $this->AdminModel->orderDataView($id);
	    $this->load->view('admin/order_detail_view',['dataOrderView'=>$dataOrderView]);
	}
	public function notesModify($type, $id=0){
	   if($type == 'add'){
	       $appointTeacher = $this->AdminModel->teacherData();
	       $this->load->view('admin/modify_notes',['appointTeacher'=>$appointTeacher]);
	   }
	   if($type =='addNote'){
	       $allow_ext = array('png','jpg','jpeg','JPEG','pdf', 'doc', 'docx');
			$file_ext = image_extension($_FILES['file']['name']);
			if(in_array($file_ext,$allow_ext))
			{
				$file = create_image_unique($_FILES['file']['name']);
				$file_name = 'uploads/notes/'.$file;
				
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'uploads/notes/'.$file;
				move_uploaded_file($tmp_name,$path);
				$details = $this->input->post();
				
				
				$details['file'] = $file_name;
				$data = $this->AdminModel->notesModify($details);
				$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
				redirect('admin/notes');
			}
	   }
	   if($type == 'edit'){
	       $appointTeacher = $this->AdminModel->teacherData();
	       $noteData = $this->AdminModel->noteData($id);
	       $this->load->view('admin/edit_notes',['appointTeacher'=>$appointTeacher , 'noteData'=>$noteData]);
	   }
	   if($type == 'editNote'){
	       if(empty($_FILES['file']['name']))
						{
							//echo 'invalid'
							$noteData = $this->AdminModel->noteData($id);
							$details = $this->input->post();
							$details['file'] = $noteData->file;
							
							$data = $this->AdminModel->editNotes($details);
							$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
							redirect('admin/notes');
						}
						else
						{
								$allow_ext = array('png','jpg','jpeg','JPEG','pdf', 'doc', 'docx');
								$file_ext = image_extension($_FILES['file']['name']);
								if(in_array($file_ext,$allow_ext))
								{
									$file = create_image_unique($_FILES['file']['name']);
									$file_name = 'uploads/notes/'.$file;
									
									$tmp_name = $_FILES['file']['tmp_name'];
									$path = 'uploads/notes/'.$file;
									move_uploaded_file($tmp_name,$path);
									$details = $this->input->post();
									
									
									$details['file'] = $file_name;
									$data = $this->AdminModel->editNotes($details);
									$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
									redirect('admin/notes');
								}
								else
								{
									$this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Added....!</div>');
									redirect('admin/notes');
									
								}
						}
	   }
	}
	public function notes()
	{
	    $data=$this->AdminModel->notesData();
		$this->load->view('admin/notes',['notesList'=>$data]);
			
	}
	public function liveClasses()
	{
	    $data=$this->AdminModel->liveClassesData();
		$this->load->view('admin/live_class_list',['liveClassList'=>$data]);
			
	}
	public function modifyClasses($type, $id=0){
	    if($type == 'add'){
	        $appointTeacher = $this->AdminModel->teacherData();
	        $this->load->view('admin/modify_live_class',['appointTeacher'=>$appointTeacher]);
	    }
	    if($type == 'addClass'){
	        $allow_ext = array('png','jpg','jpeg','JPEG','mp4','3gp','flv','mkv');
			$file_ext = image_extension($_FILES['video']['name']);
			if(in_array($file_ext,$allow_ext))
			{
				$file = create_image_unique($_FILES['video']['name']);
				$file_name = 'uploads/live_classes/'.$file;
				
				$tmp_name = $_FILES['video']['tmp_name'];
				$path = 'uploads/live_classes/'.$file;
				move_uploaded_file($tmp_name,$path);
				$details = $this->input->post();
				
				
				$details['video'] = $file_name;
			
				$data = $this->AdminModel->modifyClasses($details);
				$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
				redirect('admin/liveClasses');
			}
	    }
	    if($type == 'edit'){
	        
	       $appointTeacher = $this->AdminModel->teacherData();
	       
	       $liveData = $this->AdminModel->liveData($id);
	       $this->load->view('admin/edit_video_class',['appointTeacher'=>$appointTeacher , 'liveData'=>$liveData]);
	    }
	    if($type == 'editClass'){
	        if(empty($_FILES['video']['name']))
						{
						   
							$liveData = $this->AdminModel->liveData($id);
							$details = $this->input->post();
							$details['video'] = $liveData->video;
							$data = $this->AdminModel->editLiveClass($details);
							$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Updated....!</div>');
							redirect('admin/liveClasses');
						}
						else
						{
								$allow_ext = array('png','jpg','jpeg','JPEG','mp4','3gp','flv','mkv');
								$file_ext = image_extension($_FILES['video']['name']);
								if(in_array($file_ext,$allow_ext))
								{
									$file = create_image_unique($_FILES['video']['name']);
									$file_name = 'uploads/live_classes/'.$file;
									
									$tmp_name = $_FILES['video']['tmp_name'];
									$path = 'uploads/live_classes/'.$file;
									move_uploaded_file($tmp_name,$path);
									$details = $this->input->post();
									
									
									$details['video'] = $file_name;
									$data = $this->AdminModel->editLiveClass($details);
									$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Updated....!</div>');
									redirect('admin/liveClasses');
								}
								else
								{
									$this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Added....!</div>');
									redirect('admin/liveClasses');
									
								}
						}
	    }
	}
	
	public function subject(){
	     $data=$this->AdminModel->subjectData();
		 $this->load->view('admin/subject_list',['subjectList'=>$data]);
	}
	
	public function modifySubject($type, $id=0){
	    if($type == 'add'){
	        $this->load->view('admin/modify_subject');
	    }
	    if($type == 'addSubject'){
	        $details = $this->input->post();
	        $data = $this->AdminModel->modifySubject($details);
			$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
			redirect('admin/subject');
	    }
	    if($type == 'edit'){
	        $subjectData = $this->AdminModel->subjectDataList($id);
	       $this->load->view('admin/edit_subject',['subjectData'=>$subjectData]);
	    }
	    if($type == 'editSubject'){
	        $details = $this->input->post();
	        $data = $this->AdminModel->editSubject($details);
			$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
			redirect('admin/subject');
	    }
	}	
	public function FirebaseData($name)
        {
               $res = $this->AdminModel->firebaseData();
               foreach ($res as $key) {
                $this->config->load('androidfcm',true);
                $API_ACCESS_KEY = $this->config->item('API_ACCESS_KEY','androidfcm');
                $registrationIds = array($key->fcm_id);
                $msg = array
                (
                    'body'      => $name,
                    'title'     => "Learnup",
                    // 'icon'      => 'http://contest11.com/c11_web/img/contestlogo1.png',
                    // 'image'     => 'http://contest11.com/c11_web/img/how-to-play/step_4.png',
                    'vibrate'   => 1,
                    'sound'     => 1,
                );
                $fields = array
                (
                    'registration_ids'  => $registrationIds,
                    'notification'      => $msg
                );

                $headers = array             
                (
                    'Authorization: key=' . $API_ACCESS_KEY,
                    'Content-Type: application/json'
                );
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch );
                curl_close( $ch );
              }
         
        }
    public function mockTest(){
         $data=$this->AdminModel->mockTestData();
		 $this->load->view('admin/mock_test_list',['mockList'=>$data]);
    }
    public function modifyMockTest($type, $id=0){
        if($type == 'add'){
            $appointTeacher = $this->AdminModel->teacherData();
	        $this->load->view('admin/add_mock_test',['appoint_teacher'=>$appointTeacher]);
	    }
	    if($type == 'addMockTest'){
	        
	        	$allow_ext = array('png','jpg','jpeg','JPEG','jfif');
				$file_ext = image_extension($_FILES['mock_test_image']['name']);
				if(in_array($file_ext,$allow_ext))
				{
					$file = create_image_unique($_FILES['mock_test_image']['name']);
					$file_name = 'uploads/mock_test/'.$file;
					$tmp_name = $_FILES['mock_test_image']['tmp_name'];
					$path = 'uploads/mock_test/'.$file;
					move_uploaded_file($tmp_name,$path);
					$details = $this->input->post();
					
					$details['mock_test_image'] = $file_name;
					$data = $this->AdminModel->modifyMockTest($details);
					$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
					redirect('admin/mockTest');
				}
				else
				{
					$this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Added....!</div>');
					redirect('admin/mockTest');
				}
	    }
	    if($type == 'edit'){
	        $data = $this->AdminModel->mockData($id);
	        $appointTeacher = $this->AdminModel->teacherData();
	        $this->load->view('admin/edit_mock_test',['appoint_teacher'=>$appointTeacher,'editMock'=>$data]);
	    }
	    if($type == 'editMockTest'){
	       
	        if(empty($_FILES['mock_test_image']['name'])){
	            $data = $this->AdminModel->mockData($id);
	            $details = $this->input->post();
				$details['mock_test_image'] = $data->mock_test_image;
				$datas = $this->AdminModel->editMockTest($details,$id);
				$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Updated....!</div>');
				redirect('admin/mockTest');
	        }
	        else{
	            $allow_ext = array('png','jpg','jpeg','JPEG','jfif');
				$file_ext = image_extension($_FILES['mock_test_image']['name']);
				if(in_array($file_ext,$allow_ext))
				{
					$file = create_image_unique($_FILES['mock_test_image']['name']);
					$file_name = 'uploads/mock_test/'.$file;
					$tmp_name = $_FILES['mock_test_image']['tmp_name'];
					$path = 'uploads/mock_test/'.$file;
					move_uploaded_file($tmp_name,$path);
					$details = $this->input->post();
					
					$details['mock_test_image'] = $file_name;
					$data = $this->AdminModel->editMockTest($details,$id);
					$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Updated....!</div>');
					redirect('admin/mockTest');
				}
				else
				{
					$this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Updated....!</div>');
					redirect('admin/mockTest');
				}
	        }
	    }
    }
    public function mockQuestion($id){
        $data = $this->AdminModel->mockQuestionData($id);
        $this->load->view('admin/mock_question_list',['mockQuestion'=>$data,'mock_id'=>$id]);
    }
    public function addMockQuestion($mock_id){
        $this->load->view('admin/add_mocktest_question',['mock_id'=>$mock_id]);
    }
    public function modifyMockQuestion($type, $id=0){
        if($type == 'addMockQuestion'){
        if(empty($_FILES['mock_question_image']['name'])){
            $details = $this->input->post();
            $details['mock_question_image'] = '';
			$data = $this->AdminModel->addMockQuestion($details);
			$mock_id = $this->input->post('mock_id');
			$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
			redirect('admin/mockQuestion/'.$mock_id);
        }else{
            	$allow_ext = array('png','jpg','jpeg','JPEG','jfif');
				$file_ext = image_extension($_FILES['mock_question_image']['name']);
				if(in_array($file_ext,$allow_ext))
				{
					$file = create_image_unique($_FILES['mock_question_image']['name']);
					$file_name = 'uploads/mock_question/'.$file;
					$tmp_name = $_FILES['mock_question_image']['tmp_name'];
					$path = 'uploads/mock_question/'.$file;
					move_uploaded_file($tmp_name,$path);
					$details = $this->input->post();
					
					$details['mock_question_image'] = $file_name;
					$data = $this->AdminModel->addMockQuestion($details);
					$mock_id = $this->input->post('mock_id');
					$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Added....!</div>');
					redirect('admin/mockQuestion/'.$mock_id);
				}
				else
				{
					$this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Added....!</div>');
					redirect('admin/mockQuestion');
				}
            }
        }
        if($type == 'edit'){
            $data = $this->AdminModel->mockQuestionDetail($id);
            $this->load->view('admin/edit_mocktest_questions',['editMockQuestion'=>$data]);
        }
        if($type == 'editMockQuestion'){
            if(empty($_FILES['mock_question_image']['name'])){
                $data = $this->AdminModel->mockQuestionDetail($id);
                $details = $this->input->post();
                $details['mock_question_image'] = $data->mock_question_image;
                $value = $this->AdminModel->editMockQuestion($id,$details);
                $mock_id = $this->input->post('mock_id');
				$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Updated....!</div>');
				redirect('admin/mockQuestion/'.$mock_id);
            }
        else{
             	$allow_ext = array('png','jpg','jpeg','JPEG','jfif');
				$file_ext = image_extension($_FILES['mock_question_image']['name']);
				if(in_array($file_ext,$allow_ext))
				{
					$file = create_image_unique($_FILES['mock_question_image']['name']);
					$file_name = 'uploads/mock_question/'.$file;
					$tmp_name = $_FILES['mock_question_image']['tmp_name'];
					$path = 'uploads/mock_question/'.$file;
					move_uploaded_file($tmp_name,$path);
					$details = $this->input->post();
					
					$details['mock_question_image'] = $file_name;
					$data = $this->AdminModel->editMockQuestion($id,$details);
					$mock_id = $this->input->post('mock_id');
					$this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Successfully Updated....!</div>');
					redirect('admin/mockQuestion/'.$mock_id);
				}
				else
				{
					$this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Detail Not Updated....!</div>');
					redirect('admin/mockQuestion');
				}
            }
        }
    }
    public function removeQuestionImage($id){
        $this->load->library('user_agent');
        $data = $this->AdminModel->removeQuestionImage($id);
        redirect($this->agent->referrer());
    }
    public function doubt(){
        $data = $this->AdminModel->doubtList();
        $this->load->view('admin/doubt_list',['doubtList'=>$data]);
    }
    public function attendance($id){
        $data = $this->AdminModel->attendanceList($id);
        $this->load->view('admin/attendance_list',['attendanceList'=>$data]);
    }
    public function courseComment($id){
        $data = $this->AdminModel->commentCourseList($id);
        $this->load->view('admin/commentCourse_list',['commentCourseList'=>$data]);
    }
    public function commentLiveClass($id)
    {
        $data = $this->AdminModel->commentLiveList($id);
        $this->load->view('admin/commentLive_list',['commentLiveList'=>$data]);
    }
    public function replyDoubt(){
        $data = $this->AdminModel->replyDoubt();
        redirect('admin/doubt');
    }
    public function replyCourseComment(){
        $this->load->library('user_agent');
        $data = $this->AdminModel->replyCourseComment();
        redirect($this->agent->referrer());
    }
    public function liveClassCourseComment(){
        $this->load->library('user_agent');
        $data = $this->AdminModel->liveClassCourseComment();
        redirect($this->agent->referrer());
    }
    public function youtubeVideo($id){
        $q = $this->AdminModel->teacherData();
        $this->load->library('curl');
        $result = $this->curl->simple_get('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=UCJfzULTTZbTFW37uSTh45PQ&maxResults=50&key=AIzaSyC90NG0Zc0YgmAQdv1JBWA2MP4E9AFmiLs');
        $youtube['youtube']=json_decode($result);
        $youtubeData=array();
        $datas = array();
        
            foreach($q as $key=>$value){ 
                $videoIds=array();
            foreach($youtube as $val){
                
                     
             $data = $val->items;
             $data11 =array();
            foreach($data as $vid){
                
               
                $title = $vid->snippet;
                $date = $title->publishTime;
                $channelId = $title->channelId;
                $titl = $title->title;
                $video = $vid->id;
                if(!empty($video->videoId)){
                    $videoId = $video->videoId;    
                }
                else{
                    $videoId = '';
                }
                
                $name = $value->teacher_name;
                $teacher_id = $value->teacher_id;
                $liveBroadcastContent = $title->liveBroadcastContent;
                $thumbnails = $title->thumbnails;
                
        

                foreach($thumbnails as $url){
                    $image = $url->url;
                }
                
               if(strpos($titl, $name) !== false){
                   if($teacher_id == $id){
                  $youtubeData[$key]['teacherID'] = $teacher_id;
                  $youtubeData[$key]['teacherName'] = $name;
                    
                    
                    
                     $videoIds['date']=$date;
                     $videoIds['title']=$titl;
                     $videoIds['liveBroadcastContent']=$liveBroadcastContent;
                     $videoIds['image']=$image;
                     $videoIds['ID']=$videoId;
                     $videoIds['commentCount']=strval( 0 );
                     $youtubeData[$key]['videoID'][] = $videoIds;
                     
                    }
          
                }
             }
        }
        }
        $this->load->view('admin/youtubeVideo',['youtube'=>$youtubeData]);
    }
    public function remove_comment($val,$id){
        $this->load->library('user_agent');
        $data = $this->AdminModel->remove_comment($val,$id);
        redirect($this->agent->referrer());
    }
    public function studentStatus($val,$id){
        $data = $this->AdminModel->studentStatus($val,$id);
        if($data){
            if($val=='0'){
        $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Suspended Successfully....!</div>');
            }
            else{
                $this->session->set_flashdata('msg','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Live Successfully....!</div>');
            }
		redirect('admin/students');
        }
        else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Not Suspend ....!</div>');
		redirect('admin/students');
        }
    }
    public function youtubeVideoComments($youtubeVIdeoID){
        $data = $this->AdminModel->youtubeVideoComments($youtubeVIdeoID);
        $this->load->view('admin/youtubeComment',['commentLiveList'=>$data]);
    }

}	
?>