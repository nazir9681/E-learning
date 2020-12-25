<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LearningApi extends CI_controller
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->load->model('LearningApiModel','LearnApi');
    }
    
    public function sendmail($to,$subject,$body) {
    
        $this->load->library('email'); 
        $this->email->from('welcome@contest11.com', 'Online Learning');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->set_mailtype("html");
        $r = $this->email->send(); 
        $errors = array();
        if(!$r) {
          echo $this->email->print_debugger();
        }
        	return $r; 
    }
    
    
    public function sendOtp()
    {
    	    
            if(!empty($this->input->post('user_id'))){
            	    
                    $mobileCheck=$this->LearnApi->studentnumberCheck();
            	    
            	    if(count($mobileCheck)<=0){
                    
                            $this->load->library('curl');
                			$otp=rand(1111,9999);
                			$mobile=$this->input->post('mobile');
                			// $sms="http://zapsms.co.in/vendorsms/pushsms.aspx?user=dpandit&password=sandeep1&msisdn=".$user_mobile."&sid=CELEVN&msg=You OTP is ".$otp."&fl=0&gwid=2";
                			$msg='OTP is '.$otp;
                			
                			$sms='http://zapsms.co.in/vendorsms/pushsms.aspx?user=dpandit&password=sandeep1&msisdn='.$mobile.'&sid=CELEVN&msg='.$otp.'&fl=0&gwid=2';
                			$result = $this->curl->simple_get($sms);
                	   		$data = json_decode($result);
                	   		
                
                			if($data->ErrorMessage=="Success")
                			{
                				// $otpCount = $this->LearnApi->otpCount();
                				echo json_encode(array('status' => 'success','otp'=>$otp,'msg' => 'Otp resent successfully'));
                			}else{
                				echo json_encode(array('status' => 'failure'));
                			}
            	    }else{
                        
                        $data = array ('status' => 'failure','msg' => 'Number Already register with other account..!');
            		   echo json_encode($data); 
                    }
            }else{
                
                $this->load->library('curl');
                			$otp=rand(1111,9999);
                			$mobile=$this->input->post('mobile');
                			// $sms="http://zapsms.co.in/vendorsms/pushsms.aspx?user=dpandit&password=sandeep1&msisdn=".$user_mobile."&sid=CELEVN&msg=You OTP is ".$otp."&fl=0&gwid=2";
                			$msg='OTP is '.$otp;
                			
                			$sms='http://zapsms.co.in/vendorsms/pushsms.aspx?user=dpandit&password=sandeep1&msisdn='.$mobile.'&sid=CELEVN&msg='.$otp.'&fl=0&gwid=2';
                			$result = $this->curl->simple_get($sms);
                	   		$data = json_decode($result);
                	   		
                
                			if($data->ErrorMessage=="Success")
                			{
                				
                				echo json_encode(array('status' => 'success','otp'=>$otp,'msg' => 'Otp resent successfully'));
                			}else{
                				echo json_encode(array('status' => 'failure'));
                			}
                
                
            }
            
    }
    public function registration() {
          
        $this->load->helper('string');
		$session_key=random_string('alnum', 60);
		$unique_id = 'OS'.substr(str_shuffle('98765432101234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'),0,8);
     
            $this->studentEmailCheck();
            $this->studentnumberCheck();
            
            $req = $this->LearnApi->registration($session_key,$unique_id);
             
             if($req){
                 
                 $info = ['user_id'=>$req,
                          'full_name'=>$this->input->post('full_name'),
                          'email'=>$this->input->post('email'),
                          'number'=>$this->input->post('mobile'),
                            ];
                 
                 //$data = array( 'status' => 'success','user_id'=>$req,'session_key'=>$session_key,'msg' => 'register success' );				
                 $data = array( 'status' => 'success','User_data'=>$info,'session_key'=>$session_key,'msg' => 'register success' );				
    			
             }else{
                 
                 $data = array( 'status' => 'failed');	
             }
        
            echo json_encode($data);
    }
    public function login() {
          
        $this->load->helper('string');
		$session_key=random_string('alnum', 60);
		
		   $req = $this->LearnApi->login($session_key);
             
            if($req){
                 
                 if($req['status']==1){
                 
                 $info = ['user_id'=>$req['user_id'],
                          'full_name'=>$req['full_name'],
                          'email'=>$req['email'],
                          'number'=>$req['number'],
                            ];
                 
                 //$data = array( 'status' => 'success','user_id'=>$req,'session_key'=>$session_key,'msg' => 'register success' );				
                 $data = array( 'status' => 'success','User_data'=>$info,'session_key'=>$session_key,'msg' => 'Login successfully' );				
                
                 }else{
                     
                     $data = array( 'status' => 'failed','msg' => 'Your account not active');	
                 }
             
                     
            }else{
                 
                 $data = array( 'status' => 'failed','msg' => 'Invalid login credentials');	
             }
        
            echo json_encode($data);
    }
    public function changePassword() {
          
		
		    $req = $this->LearnApi->changePassword();
            
    }
     
    public function course() {
          
		
		    $course = $this->LearnApi->courses();
		    $req = $this->LearnApi->banner();
           
    		$data = array ('status' => 'Success','course'=>$course,'banner'=>$req);
    		echo json_encode($data);
    			
    }
    
    public function forgot_pass()
	{
		$q=$this->LearnApi->forgot_email_check($this->input->post('user_email'));
		
		if(!empty($q)){
    		
    		
    		$pass=$this->LearnApi->forgot_password($q->student_email,$q->student_id);
    		
    		$to = $q->student_email;
            $subject = 'Forgot Password';
            $body = $this->load->view('emailtemplate/forgot_password.php',['data'=>$q,'pass'=>$pass],TRUE);;
            $sendemail = $this->sendmail($to,$subject,$body);    
            
            if($sendemail)
    			{
    				$data = array ('status' => 'Success','msg' => 'Mail send successfully');
    		 		echo json_encode($data);
    			}
    			else
    			{
    				$data = array ('status' => 'failure','msg' => 'Somthing Worng.Please try again!!..');
    		 		echo json_encode($data); 
    			}
    			
		}else{
		    
		    $data = array ('status' => 'failure','msg' => 'Email is not registed with us..!');
    		 		echo json_encode($data); 
		}		
	}
    
    public function studentEmailCheck()
    {
        $q = $this->LearnApi->studentEmailCheck();
        if(count($q)>0){
            
           $data = array ('status' => 'failure','msg' => 'Email Already register with other account..!');
		 
            echo json_encode($data);die;
            
        }
        /*else{
            
            $data = array ('status' => 'sucess');
		    
        }*/
        
        //echo json_encode($data);die;
    }
    public function studentnumberCheck()
    {
        $q = $this->LearnApi->studentnumberCheck();
        if(count($q)>0){
            
           $data = array ('status' => 'failure','msg' => 'Number Already register with other account..!');
        
            echo json_encode($data);die;
        }
        /*else{
            
            $data = array ('status' => 'sucess');
        }*/
        
        
    }
    public function payment()
    {
        
        if(!empty($this->input->post('teacher_id')) && !empty($this->input->post('user_id')) && !empty($this->input->post('transaction_id')) && !empty($this->input->post('amount'))){
            $q = $this->LearnApi->payment();
            
            if($q){
                
                $data = array ('status' => 'success','msg'=>'Transaction success');
            }else{
                
                $data = array ('status' => 'failed','msg'=>'Transaction failed');
            }
        }else{
            
            $data = array ('status' => 'Invalid Request');
        }    
            
            echo json_encode($data);die;
        
    }
    public function comments()
    {
        $q = $this->LearnApi->comments();
        
        $data = array ('status' => 'success','data' =>$q);
        echo json_encode($data);die;
        
    }
    
    public function liveClassesComments()
    {   
        //if(!empty($this->input->post('student_id')) && !empty($this->input->post('youtubeVideoId')) && !empty($this->input->post('comment')) && !empty($this->input->post('teacher_id')) && !empty($this->input->post('type'))){
        if(!empty($this->input->post('student_id')) && !empty($this->input->post('classes_id')) && !empty($this->input->post('comment')) && !empty($this->input->post('teacher_id')) && !empty($this->input->post('type'))){
        
            $q = $this->LearnApi->addLivecomment();
            
            $data = array ('status' => 'success');
            echo json_encode($data);die;
            
        }else{
            
            
            $data = array ('status' => 'failed','msg'=>'Invalid Request');
            
        }  
        
        echo json_encode($data);die;
        
    }
    public function liveComments()
    {
        $q = $this->LearnApi->liveComment();
        
        $data = array ('status' => 'success','data' =>$q);
        echo json_encode($data);die;
        
    }
    public function teachers()
    {
        $user_id = $this->input->post('user_id');
	    $teacher_id = $this->input->post('teacher_id');
        $q = $this->LearnApi->teachersList($user_id,$teacher_id);
        
        $data = array ('status' => 'success','data' =>$q);
        echo json_encode($data);die;
        
    }
    public function notes()
    {
        $teacher_id = $this->input->post('teacher_id');
	     $user_id = $this->input->post('student_id');
	    
        $q = $this->LearnApi->notes();
        $teach = $this->LearnApi->teachersList($user_id,$teacher_id);
        
        $teach1 = $this->LearnApi->teacherPaidQuery($user_id,$teacher_id);
        
      
        $this->load->library('curl');
        // $result = $this->curl->simple_get('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=UChCHMQJjNFAh_-Arr6qnnHQ&maxResults=50&key=AIzaSyCnc_ykCNhFnPOZaM_5K6G_TJS43q47AVI');
        
        // $result = $this->curl->simple_get('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=UCbjozK_PYCTLEluFlrJ8UZg&maxResults=50&key=AIzaSyDsHPhLbkAF7xfSBxcwLuAcLbjWHocuaWQ');
    
        // $youtube['youtube']=json_decode($result);
        // $youtubeData=array();
        $youtubeDatas=array();
        
        // foreach($teach as $key=>$value){ 
        //         $videoIds=array();
        //     foreach($youtube as $val){
                
                     
        //      $data = $val->items;
        //      $data11 =array();
        //     foreach($data as $vid){
                
               
        //         $title = $vid->snippet;
        //         $date = $title->publishTime;
        //         $channelId = $title->channelId;
        //         $titl = $title->title;
        //         $video = $vid->id;
                
                
        //         if(!empty($video->videoId)){
        //             $videoId = $video->videoId;    
        //         }
        //         else{
        //             $videoId = '';
        //         }
        //         //print_r($videoId);
        //         $name = $value->teacher_name;
        //         $teacher_id = $value->teacher_id;
        //         $liveBroadcastContent = $title->liveBroadcastContent;
        //         $thumbnails = $title->thumbnails;
             
        //         foreach($thumbnails as $url){
        //             $image = $url->url;
        //         }
        //         if(strpos($titl, $name) !== false){
        //           $youtubeData[$key]['teacherID'] = $teacher_id;
        //           $youtubeData[$key]['teacherName'] = $name;
                    
        //             if($teacher_id==$teach1->teacher_id && $teach1->payment_status == 'PAID'){
                    
        //              $videoIds['date']=$date;
        //              $videoIds['title']=$titl;
        //              $videoIds['liveBroadcastContent']=$liveBroadcastContent;
        //              $videoIds['image']=$image;
        //              $count = $this->LearnApi->youtubeCommentCount($videoId);
        //              $videoIds['ID']=$videoId;
        //              $videoIds['commentCount']=strval( $count );
        //              $youtubeData[$key]['videoID'][] = $videoIds;
                     
        //             }
        //             else{
        //              $videoIds['date']=$date;
        //              $videoIds['title']=$titl;
        //              $videoIds['liveBroadcastContent']=$liveBroadcastContent;
        //              $videoIds['image']=$image;
        //              $count = $this->LearnApi->youtubeCommentCount($videoId);
        //              $videoIds['ID']=$videoId;
        //              $videoIds['commentCount']=strval( $count );
        //             //  for($i=0; $i<=2; $i++){
        //              $youtubeData[$key]['videoID'][0] = $videoIds;
        //             //  }
        //             }
          
        //         }
        //      }
        // }
        // }
        
                if($teacher_id==$teach1->teacher_id && $teach1->payment_status == 'PAID'){
                    
                }else{
                    
                }
                $data = array ('status' => 'success','notes' =>$q['notes'],'live_classes'=>$youtubeDatas,'custom_classes'=>$q['classes'],'doubt'=>$q['doubt'], 'mock'=>$q['mock'], 'msg'=>'success');
                
            
        echo json_encode($data);die;
        
    }
    public function addComments()
    {
        if(!empty($this->input->post('student_id')) && !empty($this->input->post('course_id')) && !empty($this->input->post('comment'))){
        
            $q = $this->LearnApi->addcomment();
            
            $data = array ('status' => 'success');
            echo json_encode($data);die;
            
        }else{
            
            
            $data = array ('status' => 'failed','msg'=>'Invalid Request');
            
        }  
        
        echo json_encode($data);die;
        
    }
    public function addDoubts()
    {
        if(!empty($this->input->post('user_id')) && !empty($this->input->post('teacher_id')) && !empty($this->input->post('doubt_title')))
        {
            if(empty($_FILES['doubt_image']['name']))
				{	
					$doubt_image = '';
					$q = $this->LearnApi->adddoubt($doubt_image);
				}
				else
					{
						$allow_ext = array('png','jpg','jpeg','JPEG');
						$file_ext = image_extension($_FILES['doubt_image']['name']);
						if(in_array($file_ext,$allow_ext))
						{
							$file = create_image_unique($_FILES['doubt_image']['name']);
							$doubt_image = 'uploads/doubt/'.$file;
							$tmp_name = $_FILES['doubt_image']['tmp_name'];
							$path = 'uploads/doubt/'.$file;
							move_uploaded_file($tmp_name,$path);
						    $q = $this->LearnApi->adddoubt($doubt_image);
						}
						else
						{
						    $data = array ('status' => 'failed','msg'=>'Image not Uploaded');
						}
			        }
            $data = array ('status' => 'success','msg'=>'Upload Successfully');
            echo json_encode($data);die;
            
        }
        else
        { 
            $data = array ('status' => 'failed','msg'=>'Invalid Request');
            
        }  
        
        echo json_encode($data);die;
        
    }
    public function punchAttendance()
    {
        if(!empty($this->input->post('user_id')) && !empty($this->input->post('teacher_id')))
        {
            $q = $this->LearnApi->punchAttendance();
            $data = array ('status' => 'success','msg'=>'Upload Successfully');
            echo json_encode($data);die;
        }
        else
        {  
            $data = array ('status' => 'failed','msg'=>'Invalid Request');
            echo json_encode($data);die;   
            
        }
    }
    public function attendanceDetail()
    {
        if(!empty($this->input->post('user_id')) && !empty($this->input->post('teacher_id')))
        {
            $q = $this->LearnApi->attendanceDetail();
            $data = array ('status' => 'success','data' =>$q,'msg'=>'Upload Successfully');
            echo json_encode($data);die;
        }   
        else
        {
            $data = array ('status' => 'failed','msg'=>'Invalid Request');
            echo json_encode($data);die;
        } 
    }
    public function mockTest()
    {   
        if(!empty($this->input->post('mock_id')) && !empty($this->input->post('teacher_id')))
        {
        $q = $this->LearnApi->mockTestData();
            if($q){
                $data = array ('status' => 'success','data' =>$q,'msg'=>'success');
                echo json_encode($data);die;
           }
            else{
                $data = array ('status' => 'failed','msg'=>'Invalid Request');
                echo json_encode($data);die;
            }
        }
        else{
            $data = array ('status' => 'failed','msg'=>'Invalid Request');
            echo json_encode($data);die;
        }
    }
    public function mockTestResult(){
        
        if(!empty($this->input->post('mock_id')) && !empty($this->input->post('teacher_id')) && !empty($this->input->post('user_id')))
        {
        $q = $this->LearnApi->mockTestResult();
            if($q){
                $data = array ('status' => 'success','data' =>$q,'msg'=>'Upload Successfully');
                echo json_encode($data);die;
            }
            else{
                $data = array ('status' => 'failed','msg'=>'Invalid Request');
                echo json_encode($data);die;    
            }
        }
        else{
            $data = array ('status' => 'failed','msg'=>'Invalid Request');
            echo json_encode($data);die;
        }
    }
    public function allAPI(){
        $this->load->library('curl');
        $result = $this->curl->simple_get('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=UChCHMQJjNFAh_-Arr6qnnHQ&maxResults=50&key=AIzaSyCnc_ykCNhFnPOZaM_5K6G_TJS43q47AVI');
        echo $result;
    }
    
}?>