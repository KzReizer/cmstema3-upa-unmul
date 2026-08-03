<?php

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
	}

	protected function get_master() 
	{
		$domain=$_SERVER['SERVER_NAME'];
		$tema = $this->{$this->_model}->get_tema($domain);
		
		// Fallback ke tema dengan ID 1 jika tidak ditemukan
		if($tema === false) {
			$tema = $this->{$this->_model}->get_tema_by_id(1);
		}
		
		$session_data = $this->session->userdata('bahasa');
		$data['lang']=!empty($session_data)?$session_data:'ID';
		$data['master'] = $tema;
		
		// Cek jika tema masih null/false
		if($tema === false) {
			$data['menu'] = false;
			return $data;
		}
		
		$head = $this->{$this->_model}->get_header_menu($tema->temaId);
		$menu=false;
		if($head!=false)
		{
			foreach($head as $row)
			{
				$child = $this->{$this->_model}->get_child_menu($row->pageId,$tema->temaId);
				$menu[] = array(
						  'headId'=>$row->{'pageNama'.$data['lang']},
						  'headNama'=>$row->{'pageJudul'.$data['lang']},
						  'parentId'=>$row->pageIsParent,
						  'link'=>$row->pageLink,
						  'child'=>$child);
			}
		}
		
		$data['menu'] = $menu;

		return $data;
	}

}





