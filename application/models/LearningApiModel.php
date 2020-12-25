<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 class LearningApiModel extends CI_Model
 {
     
     public function registration($session_key,$unique_id) {
         
         $data = ['student_name'=>$this->input->post('full_name'),
                  'student_email'=>$this->input->post('email'), 
                  'student_mobile_no'=>$this->input->post('mobile'), 
                  'student_password'=>$this->input->post('password'), 
                  'student_unique_id'=>$unique_id, 
                    ];
         
         
         $q = $this->db->insert('student',$data);
         if($q){
             $lid=$this->db->insert_id();
             
             $data = array('user_id'=>$lid,'session_key' => $session_key,'login_type'=>'Email','user_type'=>'Student', 'fcm_id'=>$this->input->post('fcm_id'));
    		 $q = $this->db->insert('login_session',$data);
    		 
         }
         return $lid;
     }
     
     
     public function login($session_key) {
      
        $datas =  $this->db->where('student_email',$this->input->post('email'))
                       ->where('student_password',$this->input->post('password'))
                		->get('student')
                		->row();            
         
         if($datas){
             $user_id=$datas->student_id;
             
                 $session =  $this->db->where('user_id',$user_id)
                           ->where('user_type','Student')
                    		->get('login_session')
                    		->row(); 
                    		
                 if(empty($session)){
                         
                         $data = array('user_id'=>$user_id,'session_key' => $session_key,'login_type'=>'Email','user_type'=>'Student','fcm_id'=>$this->input->post('fcm_id'));
                		 $q1 = $this->db->insert('login_session',$data);
                 
                     
                 }else{
                     
                     $q2 = $this->db->where('user_id',$user_id)
                                    ->where('user_type','Student')
						            ->update('login_session',['session_key'=>$session_key,'fcm_id'=>$this->input->post('fcm_id')]);
                 }
                 
                 $datas = ['user_id'=>$user_id,
                          'full_name'=>$datas->student_name,
                          'email'=>$datas->student_email,
                          'number'=>$datas->student_mobile_no,
                          'status'=>$datas->student_status,
                            ];
    		 
         }
         
         
         return $datas;
     }
     
    public function changePassword(){
		  
    		$datas =  $this->db->where('student_id',$this->input->post('user_id'))
                        		->get('student')
                        		->row();
    		  
    	   if($datas){
    	       
    	       $oldPasswordCheck =  $this->db->where('student_id',$this->input->post('user_id'))
                                		->where('student_password',$this->input->post('old_password'))
                                		->get('student')
                                		->row();
    	       
            	if($oldPasswordCheck){	
            	    
            	    $q = $this->db->where('student_id',$this->input->post('user_id'))
        						 ->update('student',['student_password'=>$this->input->post('password')]); 
        						 
        			    if($q){
                         
                            $data = array( 'status' => 'success','msg' => 'Password change successfully' );				
                        
                        }else{
                             
                            $data = array( 'status' => 'failed','msg' => 'Password not change');	
                        }
                     
                }else{
            	    
            	    $data = array( 'status' => 'failed','msg' => 'Old Password not match');	
            	}
    	   }else{
    	       
    	       $data = array( 'status' => 'failed','msg' => 'User not exists');
    	   }	
    	echo json_encode($data);			
	}
	
	public function forgot_email_check($user_email)
		{
			return  $this->db->where(['student_email'=>$user_email])
						    ->get('student')
						    ->row();
			
		}
		
	public function code()
		{
		   $length = 10;
            $characters = '0123456789987654321';
            $code = '';
           
           for ($i = 0; $i < $length; $i++) {
              $code .= $characters[mt_rand(0, strlen($characters) - 1)];
            } 
		    
		   return $code; 
		}	
	public function courses()
		{
			
			$course = $this->db->select(['courses.course_id','courses.course_image','courses.course_name','courses.course_duration','courses.number_slots','courses.start_date','courses.course_type','teachers.teacher_name',])
 	                    ->from('courses')
 	                    ->join('teachers', 'courses.appoint_teacher = teachers.teacher_id')
						->get('')
						->result();
			
			foreach($course as $key=>$value){
			    
			        $comments = $this->db->where('c_id=',$value->course_id)
						->get('course_comment')
						->result();
			        
			    $course[$key]->batchEnquiry = $this->code();
			    $course[$key]->course_image = base_url().''.$value->course_image;
			    $course[$key]->coment = count($comments);
			}
			
			
			
			return $course;
			
		}
	public function banner()
		{
			
		
			$banner =  $this->db->select(['offer_img'])
			                ->where(['offer_status'=>'1'])
						    ->get('offer')
						    ->result();
			foreach($banner as $key=>$value){
			    $banner[$key]->offer_img = base_url().''.$value->offer_img;
			}
			return $banner;
			
		}
	
	public function forgot_password($user_email,$user_id){
			
			$length = 8;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $pass = '';
           
           for ($i = 0; $i < $length; $i++) {
              $pass .= $characters[mt_rand(0, strlen($characters) - 1)];
            }
			
			$res=$this->db->where(['student_email'=>$user_email, 'student_id'=>$user_id])
						->update('student',['student_password'=>$pass]);
						
			return 	$pass;
			
	}	
     
    public function studentEmailCheck(){
		  
    		if(!empty($this->input->post('user_id'))){
    		    
    		
    			$q =  $this->db->where('student_email',$this->input->post('email'))
    			                ->where('student_id!=',$this->input->post('user_id'))
                				 ->get('student')
                				 ->result_array();
    		}else{
    		    
    		    $q =  $this->db->where('student_email',$this->input->post('email'))
                				 ->get('student')
                				 ->result_array();
    		}  
    		return $q;
	}
		
	public function studentnumberCheck(){
		  
		  if(!empty($this->input->post('user_id'))){
    		  
    		  $q = $this->db->where('student_mobile_no',$this->input->post('mobile'))
                				 ->where('student_id!=',$this->input->post('user_id'))
                				 ->get('student')
                				 ->result_array();
		  }else{
		      
		      $q = $this->db->where('student_mobile_no',$this->input->post('mobile'))
                				 ->get('student')
                				 ->result_array();
		      
		  }   
		  return $q;
	}
		
	public function comments(){
		  
		 $comments = $this->db->select(['course_comment.s_id','course_comment.comment','course_comment.timestamp','course_comment.admin_msg','student.student_name','student.student_profile'])
		                ->from('course_comment')
 	                    ->join('student', 'course_comment.s_id = student.student_id')
 	                    ->where('c_id=',$this->input->post('course_id'))
						->get('')
						->result();
			
			
			
			foreach($comments as $key=>$value){
			     
			     $comments[$key]->user_id = $value->s_id;
			     
			     unset($value->s_id);
    			 $words = explode(" ", $value->student_name);
    			    
    			    $shortName = '';
                	foreach ($words as $word){
                        $shortName .= strtoupper($word[0]);
                        
                        $comments[$key]->shortName = $shortName;
                        
                    }
                    if($value->admin_msg){
                        $comments[$key]->admin_msg = $value->admin_msg;
                    }
                    else{
                        $comments[$key]->admin_msg = '';
                    }
	        
			    
			}
			
			return $comments;
		  
	}
	
	public function payment() {
         date_default_timezone_set("Asia/Kolkata"); 
            $date =  date("Y-m-d");
            $time =  date("Y-m-d H:i:s");
         $data = ['teacher_id'=>$this->input->post('teacher_id'),
                  'student_id'=>$this->input->post('user_id'), 
                  'transaction_id'=>$this->input->post('transaction_id'), 
                  'paid_amount'=>$this->input->post('amount'), 
                  'payment_date'=>$date, 
                  'order_timestamp'=>$time, 
                    ];
         
         $checkUser =$this->db->where('teacher_id',$this->input->post('teacher_id'))
                               ->where('student_id',$this->input->post('user_id'))  
                              ->where('renew_status',0)
                              ->get('order_history');
         
         if(!empty($checkUser)){
         
          $this->db->where('teacher_id',$this->input->post('teacher_id'))
                   ->where('student_id',$this->input->post('user_id'))
                   ->update('order_history',['renew_status'=>'1']);
         }           
                  
         $q = $this->db->insert('order_history',$data);
         
         return $q;
     }
     
     
     public function teacherPaidQuery($user_id,$teacher_id){
         
        
        date_default_timezone_set("Asia/Kolkata"); 
        $currentDate =  date("Y-m-d");
		  
		 $teacher = $this->db->select(['teachers.teacher_id','teachers.teacher_name','teachers.teacher_profile','subject.subject_name','teachers.price','teachers.teacher_created','teachers.class_start_time','teachers.class_end_time','teachers.discount_price','teachers.duration','teachers.duration_month','teachers.duration_year'])
        		                ->from('teachers')
        					    ->join('subject', 'teachers.teacher_subject = subject.subject_id')
        					    ->where('teachers.teacher_id',$teacher_id)
        						->get('')
        						->row();
        						
		//foreach($teacher as $key=>$value){ 
		 	if($teacher->duration_year && $teacher->duration_month && $teacher->duration){
		        $teacher->validity = $teacher->duration_year.''.'Year -'. $teacher->duration_month.''.'Month -'.$teacher->duration.' Days'; 
		        $valid = ($teacher->duration_year*365)+($teacher->duration_month*30)+($teacher->duration);
		    }
		    else if($teacher->duration_month && $teacher->duration){
		        $teacher->validity = $teacher->duration_month.''.'Month -'.$teacher->duration.''.'Days'; 
		        $valid = ($teacher->duration_month*30)+($teacher->duration);
		    }
		    else if($teacher->duration_year && $teacher->duration_month){
		        $teacher->validity = $teacher->duration_year.''.'Year-'.$teacher->duration_month.''.'Month'; 
		        $valid = $teacher->duration_year;
		    }
		    else if($teacher->duration_year && $teacher->duration){
		        $teacher->validity = $teacher->duration_year.''.'Year-'.$teacher->duration.'Days'; 
		        $valid = ($teacher->duration_year*365)+($teacher->duration);
		    }
		    else if($teacher->duration_year){
		        $teacher->validity = $teacher->duration_year.''.'Year'; 
		        $valid = ($teacher->duration_year*365);
		    }
		    else if($teacher->duration_month){
		        $teacher->validity = $teacher->duration_month.''.'Month'; 
		        $valid = ($teacher->duration_month*30);
		    }
		    else{
		        $teacher->validity = $teacher->duration.''.'Days';
		        $valid = $teacher->duration;
		    }
		    
		    $attendance = $this->db->select('attendance_status')
                             ->where('user_id',$user_id)
                             ->where('teacher_id',$teacher->teacher_id)
                             ->where('attendance_created',$currentDate)
                             ->get('attendance_system')
                             ->row();
            if($attendance){ 
		        $teacher->attendance_status = $attendance->attendance_status;   
            }else{
                
                $teacher->attendance_status = 'ABSENT';
            }
            $teacher->duration = $teacher->duration;
            $teacher->class_start_time = date('h:i a', strtotime($teacher->class_start_time)); 
            $teacher->class_end_time = date('h:i a', strtotime($teacher->class_end_time));
			     
			     $pay = $this->db->select()
        		                ->from('order_history')
        		                ->where('order_history.teacher_id',$teacher->teacher_id)
        		                ->where('order_history.student_id',$user_id)
        		                ->where('order_history.renew_status','0')
        						->get('')
        						->row();
        						
        						
        						
        		
			     if(!empty($pay)){
			          $expiryDate1 = date('Y-m-d', strtotime($pay->payment_date. ' +'.$valid.'day' ));
			        if(strtotime($expiryDate1) < strtotime($currentDate)){
			            $payment_status = 'UNPAID';
			            $expiryDate =''; 
			        }
			        else{
			         $payment_status = 'PAID';
			         $expiryDate = date('Y-m-d', strtotime($pay->payment_date. ' +'.$valid.'day' ));
			         }
			     }else{
			         
			        $payment_status = 'UNPAID';
			        $expiryDate ='';
			     }
			     $created = date('Y-m-d', strtotime($teacher->teacher_created));
        		 $after_created = date('Y-m-d', strtotime($teacher->teacher_created. ' + 7 day' ));
        		 
        		 if(strtotime($after_created) > strtotime($currentDate)){
        		     $teacher->batch = 'new batch';
        		 }
        		 else{
        		     $teacher->batch = '';
        		 }
			     $teacher->payment_status = $payment_status;
			     $teacher->expiryDate = $expiryDate;
			     $teacher->payment_status = $payment_status;
			     $teacher->subject = $teacher->subject_name;
			     if($teacher->teacher_profile){
			         
			         $teacher->profile = base_url().''.$teacher->teacher_profile;
			         
			     }
			     
			     
			     unset($teacher->subject_name);
			     unset($teacher->teacher_profile);
			   
	        
			    
		//	}	
			return $teacher;
 
         
     }
     
	public function teachersList($user_id,$teacher_id){
	    date_default_timezone_set("Asia/Kolkata"); 
        $currentDate =  date("Y-m-d");
	    //$user_id = $this->input->post('user_id');
	    //$teacher_id = $this->input->post('teacher_id');
		  
		 $teacher = $this->db->select(['teachers.teacher_id','teachers.teacher_name','teachers.teacher_profile','subject.subject_name','teachers.price','teachers.teacher_created','teachers.class_start_time','teachers.class_end_time','teachers.discount_price','teachers.duration','teachers.duration_month','teachers.duration_year'])
        		                ->from('teachers')
        					    ->join('subject', 'teachers.teacher_subject = subject.subject_id')
        						->get('')
        						->result();
        						
		foreach($teacher as $key=>$value){ 
		 	if($value->duration_year && $value->duration_month && $value->duration){
		        $teacher[$key]->validity = $value->duration_year.''.'Year -'. $value->duration_month.''.'Month -'.$value->duration.' Days'; 
		        $valid = ($value->duration_year*365)+($value->duration_month*30)+($value->duration);
		    }
		    else if($value->duration_month && $value->duration){
		        $teacher[$key]->validity = $value->duration_month.''.'Month -'.$value->duration.''.'Days'; 
		        $valid = ($value->duration_month*30)+($value->duration);
		    }
		    else if($value->duration_year && $value->duration_month){
		        $teacher[$key]->validity = $value->duration_year.''.'Year-'.$value->duration_month.''.'Month'; 
		        $valid = $value->duration_year;
		    }
		    else if($value->duration_year && $value->duration){
		        $teacher[$key]->validity = $value->duration_year.''.'Year-'.$value->duration.'Days'; 
		        $valid = ($value->duration_year*365)+($value->duration);
		    }
		    else if($value->duration_year){
		        $teacher[$key]->validity = $value->duration_year.''.'Year'; 
		        $valid = ($value->duration_year*365);
		    }
		    else if($value->duration_month){
		        $teacher[$key]->validity = $value->duration_month.''.'Month'; 
		        $valid = ($value->duration_month*30);
		    }
		    else{
		        $teacher[$key]->validity = $value->duration.''.'Days';
		        $valid = $value->duration;
		    }
		    
		    $attendance = $this->db->select('attendance_status')
                             ->where('user_id',$user_id)
                             ->where('teacher_id',$value->teacher_id)
                             ->where('attendance_created',$currentDate)
                             ->get('attendance_system')
                             ->row();
            if($attendance){ 
		        $teacher[$key]->attendance_status = $attendance->attendance_status;   
            }else{
                
                $teacher[$key]->attendance_status = 'ABSENT';
            }
            $teacher[$key]->duration = $value->duration;
            $teacher[$key]->class_start_time = date('h:i a', strtotime($value->class_start_time)); 
            $teacher[$key]->class_end_time = date('h:i a', strtotime($value->class_end_time));
			     
			     $pay = $this->db->select()
        		                ->from('order_history')
        		                ->where('order_history.teacher_id',$value->teacher_id)
        		                ->where('order_history.student_id',$user_id)
        		                ->where('order_history.renew_status','0')
        						->get('')
        						->row();
        						
        						
        						
        		
			     if(!empty($pay)){
			          $expiryDate1 = date('Y-m-d', strtotime($pay->payment_date. ' +'.$valid.'day' ));
			        if(strtotime($expiryDate1) < strtotime($currentDate)){
			            $payment_status = 'UNPAID';
			            $expiryDate =''; 
			        }
			        else{
			         $payment_status = 'PAID';
			         $expiryDate = date('Y-m-d', strtotime($pay->payment_date. ' +'.$valid.'day' ));
			         }
			     }else{
			         
			        $payment_status = 'UNPAID';
			        $expiryDate ='';
			     }
			     $created = date('Y-m-d', strtotime($value->teacher_created));
        		 $after_created = date('Y-m-d', strtotime($value->teacher_created. ' + 7 day' ));
        		 
        		 if(strtotime($after_created) > strtotime($currentDate)){
        		     $teacher[$key]->batch = 'new batch';
        		 }
        		 else{
        		     $teacher[$key]->batch = '';
        		 }
			     $teacher[$key]->payment_status = $payment_status;
			     $teacher[$key]->expiryDate = $expiryDate;
			     $teacher[$key]->payment_status = $payment_status;
			     $teacher[$key]->subject = $value->subject_name;
			     if($value->teacher_profile){
			         
			         $teacher[$key]->profile = base_url().''.$value->teacher_profile;
			         
			     }
			     
			     
			     unset($value->subject_name);
			     unset($value->teacher_profile);
			    /* unset($value->s_id);
    			 $words = explode(" ", $value->student_name);
    			    
    			    $shortName = '';
                	foreach ($words as $word){
                        $shortName .= strtoupper($word[0]);
                        
                        $comments[$key]->shortName = $shortName;
                        
                    }*/
	        
			    
			}	
			return $teacher;
		  
	}	
	public function notes(){
	    date_default_timezone_set("Asia/Kolkata");
        $currentDate = date('Y-m-d H:i:s', time());
	    
	     $teacher_id = $this->input->post('teacher_id');
	     $user_id = $this->input->post('student_id');
		  
		$notes = $this->db->select(['notes.notes_title','notes.file','teachers.teacher_name','notes.t_id'])
        		          ->from('notes')
        				  ->join('teachers', 'notes.t_id = teachers.teacher_id')
        				  ->where('notes.t_id',$teacher_id)
        				  ->get('')
        				  ->result();
        						
		$classes = $this->db->select(['live_classes.title','live_classes.video','live_classes.classes_id','teachers.teacher_name','live_classes.teacher_id','live_classes.created'])
        		            ->from('live_classes')
        					->join('teachers', 'live_classes.teacher_id = teachers.teacher_id')
        					->where('live_classes.teacher_id',$teacher_id)
        					->get('')
        					->result();
        						
        $doubt = $this->db->select(['student.student_name','doubt_section.doubt_title','doubt_section.doubt_message','doubt_section.doubt_created','doubt_section.doubt_image','doubt_section.admin_msg'])
                          ->from('doubt_section')
                          ->join('student', 'doubt_section.user_id = student.student_id')
                          ->where(['doubt_section.teacher_id'=>$teacher_id])
                          ->where('doubt_section.user_id',$user_id)
                          ->get('')
                          ->result();
                          
        $check = $this->db->select('mock_id')
                      ->where('user_id',$user_id)
                      ->where('teacher_id',$teacher_id)
                      ->get('mock_result')
                      ->result();
                    
           
           $allMockID=array(); 
            foreach($check as $valueId){
                
                $allMockID[]=$valueId->mock_id;
            } 
             
            $mock=array();
            if(empty($check)){
                            $mock = $this->db->select(['mock_test.mock_subject_name','mock_test.mock_time','mock_test.mock_marks','mock_test.mock_test_image','mock_test.mock_date','mock_test.mock_id','mock_test.mock_description','mock_test.mock_negative_mark'])
                                                 ->where(['mock_test.teacher_id'=>$teacher_id])
                                                 ->get('mock_test')
                                                 ->result();
                foreach($mock as $key=>$value){ 
                    
                     $count_marks = $this->db->select()
                                            ->where('mock_id',$value->mock_id)
                                            ->get('mock_questions')
                                            ->num_rows();
                    if(empty($count_marks)){
                        $mock[$key]->mock_marks = '0';
                    }
                    else{
                        $mock[$key]->mock_marks = strval( $count_marks*$value->mock_marks );
                    }
                    
                if(empty($value->mock_test_image)){ 
                        $mock[$key]->mock_test_image = '';    
                }
                else{ 
                        $mock[$key]->mock_test_image = base_url().''.$value->mock_test_image;    
                }
                if(empty($value->mock_negative_mark)){ 
                        $mock[$key]->mock_negative_mark = '';    
                     }
                     else{ 
                        $mock[$key]->mock_negative_mark = $value->mock_negative_mark;    
                     } 
                 }
            }
            else{
             foreach($check as $value){   
                            $mock = $this->db->select(['mock_test.mock_subject_name','mock_test.mock_time','mock_test.mock_marks','mock_test.mock_test_image','mock_test.mock_date','mock_test.mock_id','mock_test.mock_description','mock_test.mock_negative_mark'])
                                                 ->where(['mock_test.teacher_id'=>$teacher_id])
                                               //  ->where_not_in('mock_test.mock_id',$allMockID)
                                                 ->get('mock_test')
                                                 ->result();
                foreach($mock as $key=>$value){
                    
                    $count_marks = $this->db->select()
                                            ->where('mock_id',$value->mock_id)
                                            ->get('mock_questions')
                                            ->num_rows();
                    if(empty($count_marks)){
                        $mock[$key]->mock_marks = '0';
                    }
                    else{
                        $mock[$key]->mock_marks = strval( $count_marks*$value->mock_marks );
                    }
                if(empty($value->mock_test_image)){ 
                        $mock[$key]->mock_test_image = '';    
                     }
                     else{ 
                        $mock[$key]->mock_test_image = base_url().''.$value->mock_test_image;    
                     } 
                if(empty($value->mock_negative_mark)){ 
                        $mock[$key]->mock_negative_mark = '';    
                     }
                     else{ 
                        $mock[$key]->mock_negative_mark = $value->mock_negative_mark;    
                     }
                 }
             }
     	}
		$i=1;	
		foreach($notes as $key=>$value){
			     
			     if($value->file){
			         
			         $notes[$key]->notes = base_url().''.$value->file;
			         
			     }
			     $notes[$key]->notesCount = $i;
			     
			     unset($value->file);
	        
			    
		$i++;	}
			
			   
		foreach($classes as $key=>$value){
			    $classes[$key]->classStatus = 'False';
			     if($value->video){ 
			         $comments = $this->db
			                        ->where('teacher_course_id=',$value->classes_id)
			                        ->where('t_id=',$teacher_id)
            						->get('live_class_comment')
            						->result();
						
        			 $classes[$key]->comment = count($comments);
			         
			         $classes[$key]->video = base_url().''.$value->video; 
			         
			         $stop_date = date('Y-m-d H:i:s', strtotime($value->created . ' +1 day'));
			         
			         if(strtotime($currentDate) < strtotime($stop_date))
			         {
        		        $classes[$key]->classStatus = 'True';
        		     }
        		 
			              
			     }  	    
		}	
		
// 		echo "<pre>";
// 		print_r()
		
		foreach($doubt as $key=>$value){
			         
			        
        			 $words = explode(" ", $value->student_name);
                        $shortName = '';
                    	foreach ($words as $word){
                            $shortName .= strtoupper($word[0]);
                            
                            $doubt[$key]->shortName = $shortName;
                            
                        }  
                     $doubt[$key]->shortName = $shortName;  
                     $doubt[$key]->doubt_created = date("Y-m-d", strtotime($value->doubt_created)); 
                     
                     if(empty($value->doubt_image)){
                        
                        $doubt[$key]->doubt_image = '';    
                     }
                     else{
                        
                        $doubt[$key]->doubt_image = base_url().''.$value->doubt_image;    
                     }
                     if(empty($value->doubt_message)){
                        $doubt[$key]->doubt_message = '';    
                     }
                     else{  
                        $doubt[$key]->doubt_message = $value->doubt_message;   
                     }
                     if(empty($value->admin_msg)){
                        $doubt[$key]->admin_msg = '';    
                     }
                     else{  
                        $doubt[$key]->admin_msg = $value->admin_msg;   
                     }
			         
		}
		
		return ['notes'=>$notes, 'doubt'=>$doubt, 'mock'=>$mock, 'classes'=>$classes];
		  
	}
	
	public function addcomment(){
		  
		   date_default_timezone_set("Asia/Kolkata"); 
            $time =  date("Y-m-d");
            //$time =  date("Y-m-d H:i:s");
		   
		    $data = ['s_id'=>$this->input->post('student_id'),
                  'c_id'=>$this->input->post('course_id'), 
                  'comment'=>$this->input->post('comment'), 
                  'timestamp'=>$time, 
                    ];
         
         
            $q = $this->db->insert('course_comment',$data);
		  
	}
	public function addLivecomment(){
		  
		   date_default_timezone_set("Asia/Kolkata"); 
            $time =  date("Y-m-d");
            //$time =  date("Y-m-d H:i:s");
		   
		    $data = ['s_id'=>$this->input->post('student_id'),
                      'teacher_course_id'=>$this->input->post('classes_id'), 
                      'comment'=>$this->input->post('comment'), 
                      't_id'=>$this->input->post('teacher_id'), 
                      'timestamp'=>$time, 
                    ];
            $q = $this->db->insert('live_class_comment',$data);	  
	}
			
	public function liveComment(){
		  
		 $comments = $this->db->select(['live_class_comment.s_id','live_class_comment.comment','live_class_comment.admin_msg','live_class_comment.timestamp','live_class_comment.type','live_class_comment.t_id'])
		                      ->from('live_class_comment')
 	                          ->where('teacher_course_id',$this->input->post('classes_id'))
						      ->get('')
						      ->result();
			
			foreach($comments as $key=>$value){
			    if($value->admin_msg){
			        $comments[$key]->admin_msg = $value->admin_msg;
			    }else{
			        $comments[$key]->admin_msg = '';
			    }
			     if($value->type=='STUDENT'){
			         $commentUserInfo = $this->db
        			                         ->where('student_id=',$value->s_id)
                    						 ->get('student')
                    						 ->row();
						
						$comments[$key]->user_id = $value->s_id;
			     
			            unset($value->s_id);
    			        $words = explode(" ", $commentUserInfo->student_name);
    			        
    			        $comments[$key]->name = $commentUserInfo->student_name;
    			        
        			    $shortName = '';
                    	foreach ($words as $word){
                            $shortName .= strtoupper($word[0]);
                            
                            $comments[$key]->shortName = $shortName;  
                        }
			     
			         
			     }elseif($value->type=='TEACHER'){
			         
			          $commentUserInfo = $this->db
        			                        ->where('teacher_id=',$value->t_id)
                    						->get('teachers')
                    						->row();
						
						$comments[$key]->user_id = $value->s_id;
			            unset($value->s_id);
    			        $words = explode(" ", $commentUserInfo->teacher_name);
    			        
    			        $comments[$key]->teacher_name = $commentUserInfo->teacher_name;
    			    
        			    $shortName = '';
                    	foreach ($words as $word){
                            $shortName .= strtoupper($word[0]);
                            
                            $comments[$key]->shortName = $shortName;
                            
                        }
			     }
			     
	        
			    
			}
			
			return $comments;
		  
	}
	public function adddoubt($doubt_image){
	   
	    
	    $data = ['user_id'=>$this->input->post('user_id'),
                  'doubt_title'=>$this->input->post('doubt_title'), 
                  'doubt_message'=>$this->input->post('doubt_message'), 
                  'doubt_image'=> $doubt_image,
                  'teacher_id'=>$this->input->post('teacher_id'),
                ];
         
         return $this->db->insert('doubt_section',$data);
	}
	public function punchAttendance(){
	    date_default_timezone_set("Asia/Kolkata"); 
            $time =  date("Y-m-d");
	    $data = ['user_id'=>$this->input->post('user_id'),
                  'attendance_status'=> 'PRESENT',
                  'teacher_id'=> $this->input->post('teacher_id'),
                  'attendance_created'=> $time 
                ];
                
                return $this->db->insert('attendance_system',$data);
               
                
	}
	public function attendanceDetail()
	{
	    $user_id = $this->input->post('user_id');
	    $teacher_id = $this->input->post('teacher_id');
	    $attendance_month = $this->input->post('attendance_month');
	    $month = date("n", strtotime($attendance_month));
	    $month_name = date("F", strtotime($attendance_month));
	    $year = date("Y", strtotime($attendance_month));
	    $day = date("d", strtotime($attendance_month));
	   
	    $month_days=cal_days_in_month(CAL_GREGORIAN,$month,$year);
	   
	    $q = $this->db->select('')
	                  ->where('user_id',$user_id)
	                  ->where('teacher_id',$teacher_id)
	                  ->where('YEAR(attendance_created)',$year)
	                  ->where('MONTH(attendance_created)',$month)
	                  ->get('attendance_system')
	                  ->num_rows();
	                  
	                            
	                       
                            	 $absent_status = $month_days - $q;
                            	 $total = $month_days;
                            	 $percentage = ($q/$month_days)*100;
                            	 //$absent_days = $day - $q;
                            	
                            	    $absent_days = $day - $q-1;    
                            	 
                            	 
                    $attendance = array(
                        'absent'=> $absent_status,
                        'present'=> $q,
                        'per' => number_format($percentage,2),
                        'total_days' => $total,
                        'month_name' => $month_name,
                        'absent_days' => $absent_days
                        );
                    
                  return $attendance;  
    	   
	}
	public function mockTestData()
	{
	    $mock_id = $this->input->post('mock_id');
	    $teacher_id = $this->input->post('teacher_id');
	    $mock = $this->db->select()
	                     ->where('mock_id',$mock_id)
	                     ->where('teacher_id',$teacher_id)
	                     ->get('mock_test')
	                     ->row();
	                     
         if($mock){
	       $marks = $mock->mock_marks;
           $time = $mock->mock_time;
           $subject = $mock->mock_subject_name;
	       $q = $this->db->select(['mock_question_id','mock_question','option_1','option_2','option_3','option_4','answer','mock_question_image'])
	                  ->where('mock_id',$mock->mock_id)
				      ->get('mock_questions')
				      ->result();
		$count = 1;
		foreach($q as $key=>$value){
		    $q[$key]->count = $count;
		    if(empty($value->mock_question_image)){
		        $q[$key]->mock_question_image = '';
		    }
		    else{
		        $q[$key]->mock_question_image = base_url().''.$value->mock_question_image;    
		    }
		    if(empty($value->option_1)){
		        $q[$key]->option_1 = '';
		    }
		    else{
		        $q[$key]->option_1 = $value->option_1;
		    }
		    if(empty($value->option_2)){
		        $q[$key]->option_2 = '';
		    }
		    else{
		        $q[$key]->option_2 = $value->option_2;
		    }
		    if(empty($value->option_3)){
		        $q[$key]->option_3 = '';
		    }
		    else{
		        $q[$key]->option_3 = $value->option_3;
		    }
		    if(empty($value->option_4)){
		        $q[$key]->option_4 = '';
		    }
		    else{
		        $q[$key]->option_4 = $value->option_4;
		    }
		    $count++;
		}
		

		return ['ques'=>$q,'marks'=>$marks, 'time'=>$time, 'subject'=>$subject,'total'=>$count-1];
        }
	}
	public function mockTestResult(){
	    
	    $answer = $this->input->post('mock_right');
	    $id = $this->input->post('mock_question_id');
	    $mock_total= $this->input->post('mock_total');
	    $mock_id = $this->input->post('mock_id');
	    $id_data = explode(",",$id);
	    $answer = explode(",",$answer);
	    $count=0;
	    foreach($id_data as $key=>$value){
	        foreach($answer as $keys=>$values){
	            if($keys == $key){
	             $q = $this->db->select()
	                       ->where('mock_question_id',$value)
	                       ->where('answer',$values)
	                       ->get('mock_questions')
	                       ->result();
	                   if($q){
	                       $count++;
	                   }
	            }
	        }
	    }
	    
	     $quee = $this->db->select(['mock_question_id','mock_question','answer'])
	                            ->where('mock_id',$mock_id)
	                       ->get('mock_questions')
	                       ->result();
	                       
	       $datas = array(
					'ques_id' => $id_data,
					'useranser' => $answer,
						);

			$summary = [];
				foreach( $datas as $col => $data ){
					foreach( $data as $key => $value ){
						$summary[$key][$col] = $value;
					}
				}
			$userGiven=0;
			foreach($summary as $dataCount){
			    if($dataCount['ques_id'] && $dataCount['useranser']){
			    $userGiven++;
			    }
			}
        $i=1;
        $marks = $this->db->select(['mock_marks','mock_negative_mark'])
                          ->where('mock_id',$mock_id)
                          ->get('mock_test')
                          ->row();
                          
	   foreach($quee as $key=>$value){
	        $quee[$key]->userAnswer = '';
	        $quee[$key]->count = $i;
	       foreach($summary as $keys=>$values){  
	          if($value->mock_question_id==$values['ques_id']){ 
	              $quee[$key]->userAnswer = $values['useranser'];
	              break;
	          }
	       }
	       $i++;
	   }
	    $data = array(
	        'mock_right'=> $count,
	        'mock_total'=> $this->input->post('mock_total'),
	        'user_id'=> $this->input->post('user_id'),
	        'teacher_id'=> $this->input->post('teacher_id'),
	        'mock_id'=> $this->input->post('mock_id')
	        );
	    $val = $this->db->insert('mock_result',$data);
	    if($val){
	        $percentage = ($count/$mock_total)*100;
	        $right = $count;
	        $wrong = $mock_total - $count;
	        
	        if($percentage <= 40){
	            $status = 'Poor';
	        }
	        if($percentage > 40 && $percentage <= 60){
	            $status = 'Average';
	        }
	        if($percentage > 60 && $percentage <= 70){
	            $status = 'Good';
	        }
	        if($percentage > 70){
	            $status = 'Excellent';
	        }
	        $total = $marks->mock_marks*$mock_total;
	        $mark = $right*$marks->mock_marks;
	        $totalWrong = $userGiven-$right;
	      
	        if(!empty($marks->mock_negative_mark)){
	        $totalWrong = $userGiven-$right;
	        $wrongMarks = $totalWrong*$marks->mock_negative_mark;
	        $mark = $mark +($wrongMarks);
	        }
	        return ['right'=>$right, 'wrong'=>$totalWrong,'marks'=>$mark,'totalMarks'=>$total,'status'=>$status,'rightData'=>$quee]; 
	    }
        
	}
	public function youtubeCommentCount($videoId){
	      return $this->db->select()
	                      ->where('teacher_course_id',$videoId)
	                      ->get('live_class_comment')
	                      ->num_rows();
	}
 }
 ?>