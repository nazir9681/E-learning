<?php

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
 } 
?>