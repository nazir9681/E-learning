<?php

function create_image_unique($file_name)
{
	$array = explode('.',$file_name);
	$file_extension = end($array);
	$new_file = substr(str_shuffle('12345678910'),0,1).str_shuffle(time()).substr(str_shuffle('12345678910'),0,1).'.'.$file_extension;
	return $new_file;
}

function image_extension($file_name)
{
	$array = explode('.',$file_name);
	$file_extension = end($array);
	return $file_extension;
}

function check_profile_pic($dir,$file)
{
	if(is_file($dir.$file))
	{
		return base_url($dir).$file;
	}
	else
	{
		return base_url("assets/front/images/")."default-avatar.png";
	}
}
function delete_file($dir,$file)
{
	if(is_file($dir.$file))
	{
		return unlink($dir.$file);
	}
}





?>
