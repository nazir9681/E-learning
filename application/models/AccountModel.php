<?php
/**
  * 
  */
 class AccountModel extends CI_Model
 {
 	public function admin_login($uname,$pass)
 	{
 		$res = $this->db->where(['admin_user_name'=>$uname, 'admin_pass'=>$pass])
						->where('admin_status',1)				  
						->get('admin');
 		if($res->num_rows())
 		{
 			return $res->row()->admin_id;
 		}else{
 			return false;
 		}
 	}
 } 
?>