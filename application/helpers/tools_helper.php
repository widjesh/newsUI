<?php
/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 7/20/2017
 * Time: 4:16 PM
 */

function get_category_name($id){
	$CI = &get_instance();
	$row = $CI->db->where('id',$id)->get('category')->row();
	$name = empty($row) ? "Not found" : $row->title;
	return $name;
}