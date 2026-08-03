<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('menu'))
{
	function menu(){
		$CI = get_instance();
		$CI->load->model('model_menu');

		$menu = false;

		$head = $CI->model_menu->get_header_menu();
		if($head!=false)
		{
			foreach($head as $row)
			{
				$child = $CI->model_menu->get_child_menu($row->susrmdgroupNama);
				if($child!=false)
					$menu[] = array('headId'=>$row->susrmdgroupNama,'headNamaID'=>$row->susrmdgroupDisplay,'headNamaEN'=>$row->susrmdgroupDisplayEng,'child'=>$child);
			}
		}
		return $menu;
	}
}
?>