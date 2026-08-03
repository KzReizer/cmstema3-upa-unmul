<?php
class Model_menu extends CI_Model
{
	public function get_data()
	{
		return $this->db->get('f_page');
	}

	function get()
	{
		$this->db->select('*');
		$this->db->from('f_page');
		// $this->db->where('pageHead');
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function get_nama($key)
	{
		$this->db->select('*');
		$this->db->from('f_page');
		$this->db->join('s_user','susrNama=pageAuthor','left');
		$this->db->where('pageNama',$key);
		$qr=$this->db->get();

		if($qr->num_rows()==1)
			return $qr->row();
		else
			return FALSE;
	}

	function get_header_menu()
	{
		$this->db->select('*');
		$this->db->from('s_user_modul_group_ref');
		$this->db->where('susrmdgroupIsDisplayFront',1);
		$this->db->order_by('susrmdgroupUrut');
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function get_child_menu($key)
	{
		$this->db->select('*');
		$this->db->from('f_page');
		$this->db->where(('pageHeadID = "'.$key.'"  or pageHeadEN = "'.$key.'"'));
		$this->db->order_by('pageUrut');
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}
}
?>