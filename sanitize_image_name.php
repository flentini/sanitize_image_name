<?php
/*
Plugin Name: sanitize_image_name
Description: allows image files to have only numbers in filename.
Author: Francesco Lentini
Version: 0.1
*/
add_filter('sanitize_file_name', 'check_imgname', 10);
add_filter('attachment_fields_to_save', 'check_attach_name', 10, 3 );

function check_imgname($filename){
	$extensions = array('jpeg','jpg','png','bmp');	
	$file_info = pathinfo($filename);
	
	if(in_array($file_info['extension'],$extensions)) {
		if(is_numeric($file_info['filename'])) {
			$filename = 'img_'.$file_info['filename'].'.'.$file_info['extension'];
		}
	}
	
	return $filename;
}


function check_attach_name($post, $attachment) {
	if(is_numeric($post['post_name'])&&substr($post['post_mime_type'], 0, 5) == 'image') {
			$post['post_name'] = 'img_'.$post['post_name'];
	}
	
	return $post;
}
