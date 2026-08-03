<?php
class Model_konten extends Model_Master	
{

	function get_kategori($number, $start = 0)
	{
		$this->db->select('*');
		$this->db->from('ref_kategori_konten');
		$this->db->limit($number, $start);
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}
	function get_konten($kategori,$tema,$number, $start = 0)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->join('ref_kategori_konten','kategoriId=kontenKategoriId','left');
		$this->db->where('kontenIsDisplay','1'); 
		$this->db->where('kategoriNama', $kategori);
		$this->db->where('kontenTemaId',$tema);		
		$this->db->order_by('kontenTanggal', 'desc');
		$this->db->order_by('kontenUrut', 'asc');
		$this->db->limit($number, $start);
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function get_terbaru($tema,$number, $start = 0)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->join('ref_kategori_konten','kategoriId=kontenKategoriId','left');
		$this->db->where('kontenIsDisplay','1');
		$this->db->where('kontenTemaId',$tema);		
		$this->db->order_by('kontenTanggal', 'desc');
		$this->db->order_by('kontenUrut', 'asc');
		$this->db->limit($number, $start);
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}


	public function getDataPagination($limit,$offset,$kategori,$tema)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->join('ref_kategori_konten','kategoriId=kontenKategoriId','left');
		$this->db->where('kontenIsDisplay','1'); 
		$this->db->where('kategoriNama',$kategori);
		$this->db->where('kontenTemaId',$tema);		
		$this->db->order_by('kontenTanggal', 'desc');
		$this->db->order_by('kontenUrut', 'asc');
		$this->db->limit($limit, $offset);
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	public function getAll($kategori,$tema)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->join('ref_kategori_konten','kategoriId=kontenKategoriId','left');
		$this->db->where('kontenIsDisplay','1'); 
		$this->db->where('kategoriNama',$kategori);
		$this->db->where('kontenTemaId',$tema);		
		$this->db->order_by('kontenTanggal', 'desc');
		$this->db->order_by('kontenUrut', 'asc');
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->num_rows;
		else
			return FALSE;

	}

	public function getDataPagination_mahasiswa($limit, $offset,$section)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->where("(kontenIsDisplay = '1' AND kontenKategoriId = '".$section."'  AND kontenTemaId = '1')");
		$this->db->OR_where("(kontenIsDisplay = '1' AND kontenKategoriId = '".$section."'  AND kontenprodiaprov = '1')");
		$this->db->OR_where("(kontenIsDisplay = '1' AND kontenKategoriId = '".$section."'  AND kontenTemaId = '15')");
		$this->db->order_by('kontenTanggal', 'desc');
		$this->db->order_by('kontenUrut', 'asc');
		$this->db->limit($limit, $offset);
		return $this->db->get();
	}

	public function getAll_mahasiswa($section)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->where("(kontenIsDisplay = '1' AND kontenKategoriId = '".$section."'  AND kontenTemaId = '1')");
		$this->db->OR_where("(kontenIsDisplay = '1' AND kontenKategoriId = '".$section."'  AND kontenprodiaprov = '1')");
		$this->db->OR_where("(kontenIsDisplay = '1' AND kontenKategoriId = '".$section."'  AND kontenTemaId = '15')");
		return $this->db->get();
	}


	function get_konten_mahasiswa($section,$number, $start = 0)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->where("(kontenIsDisplay = '1' AND kontenKategoriId = '".$section."'  AND kontenTemaId = '1')");
		$this->db->OR_where("(kontenIsDisplay = '1' AND kontenKategoriId = '".$section."'  AND kontenprodiaprov = '1')");
		$this->db->OR_where("(kontenIsDisplay = '1' AND kontenKategoriId = '".$section."'  AND kontenTemaId = '15')");
		$this->db->order_by('kontenTanggal', 'desc');
		$this->db->order_by('kontenUrut', 'asc');
		$this->db->limit($number, $start);
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}
	
	function get_konten_pin($kategori,$tema,$number =500, $start = 0)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->join('ref_kategori_konten','kategoriId=kontenKategoriId','left');
		$this->db->where('kontenIsDisplay','1'); 
		$this->db->where('kontenIsPin','1');
		$this->db->where('kategoriNama',$kategori);
		$this->db->where('kontenTemaId',$tema);  
		$this->db->order_by('kontenTanggal', 'desc');
		$this->db->order_by('kontenUrut', 'asc');
		$this->db->limit($number, $start);
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function get_nama($key)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->join('s_user','susrNama=kontenAuthor','left');
		$this->db->where('kontenNama',$key);
		$qr=$this->db->get();

		if($qr->num_rows()==1)
			return $qr->row();
		else
			return FALSE;
	}

	function get_slider($tema)
	{
		$this->db->select('*');
		$this->db->from('f_slider');
		$this->db->where('sliderTemaId',$tema);
		$this->db->where('sliderIsDisplay','1'); 
		$this->db->order_by('sliderNoUrut', 'asc');
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function get_explore($tema)
	{
		$this->db->select('*');
		$this->db->from('f_galeri');
		$this->db->where('galeriTemaId',$tema);
		$this->db->where('galeriJenis','jelajah'); 
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function get_logo($tema)
	{
		$this->db->select('*');
		$this->db->from('f_galeri');
		$this->db->where('galeriTemaId',$tema);
		$this->db->where('galeriJenis','logo'); 
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function get_logounit($tema)
	{
		$this->db->select('*');
		$this->db->from('f_galeri');
		$this->db->where('galeriTemaId',$tema);
		$this->db->where('galeriJenis','unit'); 
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function get_quote($tema, $number, $start = 0)
	{
		$this->db->select('*');
		$this->db->from('f_quote');
		$this->db->where('quoteTemaId',$tema);
		$this->db->where('quoteIsDisplay','1');
		$this->db->limit($number, $start);
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function get_statistik($tema, $number, $start = 0)
	{
		$this->db->select('*');
		$this->db->from('f_statistic');		
		$this->db->join('ref_kategori_statistik','refstatId=statRefStatId','left');
		$this->db->where('statTemaId',$tema);
		$this->db->where('statIsDisplay','1');		
		$this->db->limit($number, $start);
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function cari_konten($keyword, $temaId)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->join('s_user','susrNama=kontenAuthor','left');
		$this->db->join('ref_kategori_konten','kategoriId=kontenKategoriId','left');
		$this->db->where('kontenTemaId', $temaId);
		$this->db->like('kontenNamaId',$keyword);
		$this->db->order_by('kontenTanggal', 'desc');
		$this->db->order_by('kontenUrut', 'asc');
		// $this->db->or_like('kontenContent',$keycari);
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function kontenprodi($sgroupProdiId,$number, $start = 0)
	{
		$this->db->select('*');
		$this->db->from('f_konten');
		$this->db->where("kontenKategoriId IN ('agenda','konten','pengumuman','kegiatan')"); 
		$this->db->where('kontenTemaId', $sgroupProdiId); 
		$this->db->where('kontenIsDisplay','1'); 
		$this->db->order_by('kontenTanggal', 'desc');
		$this->db->order_by('kontenUrut', 'asc');
		if ($number == true){
			$this->db->limit($number, $start);
		}
		$qr=$this->db->get();

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

	function search($key, $temaId)
	{


		$this->db->select("kontenContent, kontenJudul, kontenBanner, kontenNama, kontenTanggal ,kontenAuthor, kontenTag,kontenKategoriId");
		$this->db->from('f_konten');
		$this->db->where('kontenTemaId', $temaId);
		$this->db->like('kontenJudul', $key);
		// $this->db->OR_like('kontenContent', $key);
		
		$query1 = $this->db->get_compiled_select();

		$this->db->select(" jurnalAbst As kontenContent, jurnalJudul As kontenJudul, jurnalJudul As kontenBanner, jurnalPenulis As kontenNama, jurnalTgl As kontenTanggal , jurnalLink As kontenAuthor, jurnalLink As kontenTag, jurnalnamaId As kontenKategoriId");
		$this->db->from('f_jurnal');
		$this->db->like('jurnalJudul', $key);
		// $this->db->OR_like('jurnalAbst', $key);
		$this->db->OR_like('jurnalPenulis', $key);
		
		$query2 = $this->db->get_compiled_select();

		// $qr = $this->db->get();

		$qr = $this->db->query($query1 . " UNION " . $query2);

		if($qr->num_rows()>0)
			return $qr->result();
		else
			return FALSE;
	}

}
?>