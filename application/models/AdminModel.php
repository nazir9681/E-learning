<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 class AdminModel extends CI_Model
 {
 	public function teacherModify($type,$id,$data)
 	{
 		
		if($type=='add'){
		
			return $this->db->insert('teachers',$data);
			
		}elseif($type=='edit'){
		
			return $this->db->where('teacher_id',$id)
							->update('teachers',$data);
		
		}
 	}
	public function teacherInfo($id)
 	{
 		return $this->db->where(['teacher_id'=>$id])
						->get('teachers')
						->row();
 	}
	public function teacherData()
 	{
 		return $this->db->select()
						->get('teachers')
						->result();
 	}
 	public function studentModify($type,$id,$data)
 	{
 		
		if($type=='add'){
		
			return $this->db->insert('student',$data);
			
		}elseif($type=='edit'){
		
			return $this->db->where('student_id',$id)
							->update('student',$data);
		
		}
 	}
	public function studentInfo($id)
 	{
 		return $this->db->where(['student_id'=>$id])
						->get('student')
						->row();
 	}
	public function studentData()
 	{
 		return $this->db->select()
						->get('student')
						->result();
 	}
 	public function courseModify($type,$id,$data)
 	{
 		
		if($type=='add'){
			return $this->db->insert('courses',$data);
			
		}elseif($type=='edit'){
		
			return $this->db->where('course_id',$id)
							->update('courses',$data);
		
		}
 	}
 	
	public function courseInfo($id)
 	{
 		return $this->db->where(['course_id'=>$id])
						->get('courses')
						->row();
 	}
	public function courseData()
 	{
 		return $this->db->select()
						->get('courses')
						->result();
 	}
	public function subAdmin()
 	{
 		return $this->db->where(['admin_role !='=>'Admin'])
						->get('admin')
						->result();
 	}
	public function adminInfo($id)
 	{
 		return $this->db->where(['admin_id'=>$id])
						->get('admin')
						->row();
 	}
	public function subadminModify($type,$id,$data)
 	{
 		
		if($type=='add'){
		
			return $this->db->insert('admin',$data);
			
		}elseif($type=='edit'){
		
			return $this->db->where('admin_id',$id)
							->update('admin',$data);
		
		}
 	}
 	public function offer($data){
 		return $this->db->insert('offer',$data);
 	}
 	public function offerData(){
 	    return $this->db->select()
						->get('offer')
						->result();   
 	}
 	public function offer_status_update($type, $id){
 	    return $this->db->where('offer_id',$id)
							->update('offer',['offer_status'=>$type]);
		
 	}
 	public function isvalidate_offer_edit($details){
 	    $id = $this->input->post('b_id');
 	    return $this->db->where('offer_id',$id)
							->update('offer',['offer_img'=>$details]);
 	}
 	public function orderData(){
 	    return $this->db->select()
 	                    ->from('order_history')
 	                    ->join('courses', 'order_history.course_id = courses.course_id','LEFT')
 	                    ->join('student', 'order_history.student_id = student.student_id')
						->get('')
						->result(); 
 	}
 	public function order_status_update($type, $id){
 	    return $this->db->where('order_id',$id)
							->update('order_history',['order_status'=>$type]);
		
 	}
 	public function orderDataView($id){
 	    return $this->db->select()
 	                    ->where('order_history.order_id',$id)
 	                    ->from('order_history')
 	                    ->join('courses', 'order_history.course_id = courses.course_id')
						->get('')
						->row();
					
 	}
 	public function notesData(){
 	    return $this->db->select()
 	                    ->from('notes')
                        ->join('teachers', 'notes.t_id = teachers.teacher_id')
                        ->get()
 	                    ->result();
 	                    
 	                    
 	}
 	public function noteData($id){
 	    return $this->db->where(['notes_id'=>$id])
						->get('notes')
						->row();
 	}
 	public function notesModify($data){
 	   
 	    return $this->db->insert('notes',$data);
 	}
 	public function editNotes($details){
 	    $id = $this->input->post('notes_id');
 	    return $this->db->where('notes_id',$id)
							->update('notes',$details);
 	}
 	public function liveClassesData(){
 	    return $this->db->select()
 	                    ->from('live_classes')
                        ->join('teachers', 'live_classes.teacher_id = teachers.teacher_id')
                        ->get()
 	                    ->result();
 	}
 	public function modifyClasses($data){
 	    return $this->db->insert('live_classes',$data);
 	}
 	public function liveData($id){
 	    return $this->db->where(['classes_id'=>$id])
						->get('live_classes')
						->row();
 	}
 	public function editLiveClass($details){
 	    $id = $this->input->post('classes_id');
 	    return $this->db->where('classes_id',$id)
							->update('live_classes',$details);
 	}
 	public function subjectData(){
 	    return $this->db->select()
                        ->get('subject')
 	                    ->result();
 	}
 	public function modifySubject($details){
 	    return $this->db->insert('subject',$details);
 	}
 	public function subjectDataList($id){
 	    return $this->db->where(['subject_id'=>$id])
						->get('subject')
						->row();
 	}
 	public function editSubject($details){
 	    $id = $this->input->post('subject_id');
 	    return $this->db->where('subject_id',$id)
							->update('subject',$details);
 	}
 	public function firebaseData(){
		return $this->db->select('fcm_id')
				        //->where('user_id',$value)
				        ->get('login_session')
				        ->result();
	}
	public function mockTestData(){
	    return $this->db->select()
	                    ->from('mock_test')
	                    ->order_by('mock_test.mock_id', "desc")
                        ->join('teachers', 'mock_test.teacher_id = teachers.teacher_id')
	                    ->get('')
	                    ->result();
	}
	public function modifyMockTest($details){
	    return $this->db->insert('mock_test',$details);
	}
	public function mockQuestionData($id){
	    return $this->db->select()
	                    ->where('mock_id',$id)
	                    ->get('mock_questions')
	                    ->result();
	}
	public function addMockQuestion($details)
	{
	   return $this->db->insert('mock_questions',$details);
	}
	public function mockData($id){
	    return $this->db->select()
	                    ->where('mock_id',$id)
	                    ->get('mock_test')
	                    ->row();
	}
	public function editMockTest($details,$id){
	    return $this->db->where('mock_id',$id)
							->update('mock_test',$details);
	}
	public function mockQuestionDetail($id){
	    return $this->db->select()
	                    ->where('mock_question_id',$id)
	                    ->get('mock_questions')
	                    ->row();
	}
	public function editMockQuestion($id,$details){
	    return $this->db->where('mock_question_id',$id)
							->update('mock_questions',$details);
	}
	public function removeQuestionImage($id){
	    $image = $this->db->select()
	                      ->where('mock_question_id',$id)
	                      ->get('mock_questions')
	                      ->row();
	   unlink($image->mock_question_image);
	   return $this->db->where('mock_question_id',$id)
							->update('mock_questions',['mock_question_image'=>'']);
	}
	public function doubtList(){
	     return $this->db->select()
	                    ->from('doubt_section')
	                    ->order_by('doubt_section.doubt_id', "desc")
	                    ->join('teachers', 'teachers.teacher_id = doubt_section.teacher_id')
	                    ->get('')
	                    ->result();
	}
	public function attendanceList($id){
	     return $this->db->select()
	                    ->from('attendance_system')
	                    ->where('user_id',$id)
	                    ->order_by('attendance_system.attendance_id', "desc")
	                    ->join('teachers', 'teachers.teacher_id = attendance_system.teacher_id')
	                    ->get()
	                    ->result();
	}
	public function commentCourseList($id){
	     return $this->db->select()
	                      ->where('c_id',$id)
	                      ->from('course_comment')
	                      ->join('student', 'course_comment.s_id=student.student_id')
	                      ->get('')
	                      ->result();
	}
	public function commentLiveList($id){
	    return $this->db->select()
	                      ->where('teacher_course_id',$id)
	                      ->from('live_class_comment')
	                      ->join('student', 'live_class_comment.s_id=student.student_id')
	                      ->join('teachers', 'live_class_comment.t_id=teachers.teacher_id')
	                      ->get('')
	                      ->result();
	}
	public function replyDoubt(){
	    return $this->db->select()
	                     ->where('doubt_id',$this->input->post('doubt_id'))
	                     ->update('doubt_section',['admin_msg'=>$this->input->post('admin_msg')]);
	}
	public function replyCourseComment()
	{
	    return $this->db->select()
	                     ->where('id',$this->input->post('id'))
	                     ->update('course_comment',['admin_msg'=>$this->input->post('admin_msg')]);
	}
	public function liveClassCourseComment(){
	    return $this->db->select()
	                     ->where('id',$this->input->post('id'))
	                     ->update('live_class_comment',['admin_msg'=>$this->input->post('admin_msg')]);
	}
	public function remove_comment($val,$id){
	    if($val == 'course'){
	        return $this->db->select()
	                     ->where('id',$id)
	                     ->update('course_comment',['admin_msg'=>'']);
	    }
	    if($val == 'doubt'){
	        return $this->db->select()
	                     ->where('doubt_id',$id)
	                     ->update('doubt_section',['admin_msg'=>'']);
	    }
	    if($val == 'live'){
	        return $this->db->select()
	                     ->where('id',$id)
	                     ->update('live_class_comment',['admin_msg'=>'']);
	    }
	}
	public function studentStatus($val,$id){
	    return $this->db->select()
	                     ->where('student_id',$id)
	                     ->update('student',['student_status'=>$val]);
	}
	public function youtubeVideoComments($youtubeVIdeoID){
	    return $this->db->select()
	                    ->from('live_class_comment')
	                     ->where('live_class_comment.teacher_course_id',$youtubeVIdeoID)
	                     ->join('student', 'live_class_comment.s_id = student.student_id')
	                     ->get('')
	                     ->result();
	}
	public function dashboardDataCount(){
	    $scount = $this->db->select()
	                    ->get('student')
	                    ->num_rows();
	                    
	   $tcount =  $this->db->select()
	                    ->get('teachers')
	                    ->num_rows();
	   $ocount = $this->db->select()
	                    ->get('order_history')
	                    ->num_rows();
	   return ['scount'=>$scount, 'tcount'=>$tcount,'ocount'=>$ocount];
	                    
	}
 } 
?>