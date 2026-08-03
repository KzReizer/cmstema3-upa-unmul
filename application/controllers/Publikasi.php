<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

class Publikasi extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->_controller_name = 'Publikasi';
        $this->_model = 'model_konten';
        $this->load->model($this->_model, '', TRUE);
		$this->load->model('model_menu', '', TRUE);
		$this->load->library('Aksesapi');
	}

	    private function semId()
    {
        return strval(date('Y') - ((date('n') <= 6) ? 1 : 0)) . strval(((date('n') <= 6) ? '2' : '1'));
    }

    public function switchlang()
	{		
		$lang=$this->input->post('lang');						
		$this->session->set_userdata('bahasa',$lang);
	}

	public function publikasi($jenis)//single post page
    {
    	$this->load->helper('datetoindo');
        $data = $this->get_master();
        $unit = $this->model_konten->get_by_id('s_unit',['unitId'=>$data['master']->temaUnitId]);
        $data['pengumuman'] = $this->model_konten->get_konten('pengumuman', $data['master']->temaId, 5);
		$data['terbaru'] = $this->model_konten->get_terbaru($data['master']->temaId, 5);
		$jenis = $this->uri->segment(3);
		if ($jenis == 'penelitian') {
			$data['jenis_publikasi'] = 'Penelitian';
			$data['jenis_publikasiEN'] = 'Research';
			$jenbkd = 'penelitian';
			$group = '' ;
		}elseif ($jenis == 'pm') {
			$data['jenis_publikasi'] = 'Pengabdian Masyarakat';
			$data['jenis_publikasiEN'] = 'Community service';
			$jenbkd = 'pm';
			$group = '' ;
		}elseif ($jenis == 'jurnal') {
			$data['jenis_publikasi'] = 'Jurnal';
			$data['jenis_publikasiEN'] = 'Journal';
			$jenbkd = 'jurnal';
			$group ='form_2';
		}elseif ($jenis == 'buku') {
			$data['jenis_publikasi'] = 'Buku';
			$data['jenis_publikasiEN'] = 'Book';
			$jenbkd = 'buku';
			$group ='form_1';
		}elseif ($jenis == 'haki') {
			$data['jenis_publikasi'] = 'Hak Kekayaan Intelektual';
			$data['jenis_publikasiEN'] = 'Intellectual Property Pights';
			$jenbkd = 'hki';
			$group ='form_6';
		}elseif ($jenis == 'seminar') {
			$data['jenis_publikasi'] = 'Seminar';
			$data['jenis_publikasiEN'] = 'Seminar';
			$jenbkd = 'seminar';
			$group ='form_3';
		}
		$api = new Aksesapi();
		$data['jenis_pub'] =$api->JenisPublikasi($jenbkd);
		$config['base_url'] = site_url('publikasi/publikasi/' . $jenis . '/');
		$tahun = $this->input->post('tahun');
		$jenisp = $this->input->post('jenisp');
		$perpage = 10;
		$linktahun = $this->uri->segment(4);
		$linkexplode = $this->uri->segment(4);
	    $offset = $this->uri->segment(5);
		$exjenisp = explode('-', $this->input->post('jenisp'));
		$exjenispexlpode = explode('-',$linkexplode);
		
		if ($exjenisp[0] == '%'){
		$cekpublikasi = $api->publikasi($tahun,'',$group,$perpage, $offset,$unit->unitKode);	
		}else{
		$cekpublikasi = $api->publikasi($tahun,$exjenisp[0],'',$perpage, $offset,$unit->unitKode);
		}
		$cekpm = $api->pengabdian($tahun,$perpage, $offset,$unit->unitKode);
		$cekpenelitian = $api->penelitian($tahun,$perpage, $offset,$unit->unitKode);
      
		if ($jenis == 'penelitian') {
			 	if ($tahun == false  or   $cekpenelitian->status == false and $linktahun != false)
			 	{
			 		
					 	  if ($linktahun == false){
					 	  	$data['dataspublikasi'] =$api->penelitian(date('Y'),$perpage, $offset,$unit->unitKode);
					 		$jumlah =$api->penelitian(date('Y'),'','',$unit->unitKode);
					 		$data['tahun'] = date('Y');
					 		$data['jenisp'] = 'Penelitian';
					 	    $jum = $jumlah->status!=false?count($jumlah->data ):'';
					 	  
				 
					 	}else{
					 		$data['dataspublikasi'] = $api->penelitian($linktahun,$perpage, $offset,$unit->unitKode);
					 		$jumlah =$api->penelitian($linktahun,'','',$unit->unitKode);
					 		$data['tahun'] = $linktahun;
					 		$data['jenisp'] = 'Penelitian';
					 		$jum = $jumlah->status!=false?count($jumlah->data ):'';
					 	}
                        //  print_r($data['dataspublikasi'] );exit();
			 	
			 	}else{
				 		$data['dataspublikasi'] = $cekpenelitian ;
				 		$jumlah =$api->penelitian($tahun,'','',$unit->unitKode);
				 		$data['tahun'] = $tahun;
				 		$data['jenisp'] = 'Penelitian';
				 		$jum = $jumlah->status!=false?count($jumlah->data ):'';
			 	}
			 	
			 }elseif ( $jenis == 'pm') {
			 
			 	if ($tahun == false or   $cekpm->status == false and $linktahun != false)
			 	{

			 		  if ($linktahun == false){
			 		  		$data['dataspublikasi'] = $api->pengabdian(date('Y'),$perpage, $offset,$unit->unitKode);
					 		$data['tahun'] = date('Y');
					 		$data['tahunpm'] =date('Y');
					 		$data['jenisp'] ='Pengabdian Masyarakat';
					 		$jumlah =$api->pengabdian(date('Y'),'','',$unit->unitKode);
					 		$jum = $jumlah->status!=false?count($jumlah->data ):'';

			 		  }else{
			 		  		$data['dataspublikasi'] = $api->pengabdian($linktahun,$perpage, $offset,$unit->unitKode);
					 		$jumlah =$api->pengabdian($linktahun,'','',$unit->unitKode);
					 		$data['tahun'] = $linktahun;
					 		$data['tahunpm'] =$linktahun;
					 		$data['jenisp'] = 'Pengabdian Masyarakat';
					 		$jum = $jumlah->status!=false?count($jumlah->data ):'';

			 		  }
			 	
			 	}else{
			 		$data['dataspublikasi'] = $cekpm ;
			 		$data['tahun'] = $tahun;
			 		$data['tahunpm'] =$tahun;
			 		$data['jenisp'] ='Pengabdian Masyarakat';
			 		$jumlah =$api->pengabdian($tahun,'','',$unit->unitKode);
			 		$jum = $jumlah->status!=false?count($jumlah->data ):'';

			 	}
			 }else { 
				 	if ($tahun == false or $jenisp == false  or   $cekpublikasi->status == false and $linktahun != false)
				 	{

				 		 if ($linktahun == false){
					 	  	$data['dataspublikasi'] =  $api->publikasi(date('Y'),'',$group,$perpage, $offset,$unit->unitKode);
					 		$jumlah =$api->publikasi(date('Y'),'',$group,'','',$unit->unitKode);
					 		$data['tahun'] = date('Y');
					 		$data['jenisp'] = $data['jenis_publikasi'];
					 	    $jum = $jumlah->status!=false?count($jumlah->data ):'';
				 
					 	}else{
					 		if ($exjenispexlpode[1] == false){
							$cekpublikasi = $api->publikasi($exjenispexlpode[0],'',$group,$perpage, $offset,$unit->unitKode);	
							$jumlah =$api->publikasi($exjenispexlpode[0],'',$group,'','',$unit->unitKode);
							}else{
							$cekpublikasi = $api->publikasi($exjenispexlpode[0],$exjenispexlpode[1],'',$perpage, $offset,$unit->unitKode);
							$jumlah =$api->publikasi($exjenispexlpode[0],$exjenispexlpode[1],'','','',$unit->unitKode);
							}
					 		$data['dataspublikasi'] = $cekpublikasi;
					 		$data['tahun'] = $exjenispexlpode[0];
					 		$data['jenisp'] =$data['jenis_publikasi'];
					 		$jum = $jumlah->status!=false?count($jumlah->data ):'';
					 	}
				 	}else{

				 		$data['dataspublikasi'] = $cekpublikasi;
				 		$data['tahun'] = $tahun;
				 		$data['jenisp'] = $data['jenis_publikasi'];
				 		   if ($exjenisp[0] =='%'){
                            $jumlah =$api->publikasi($tahun,'',$group,'','',$unit->unitKode);    
                            }else{
                             $jumlah =$api->publikasi($tahun,$exjenisp[0],'','','',$unit->unitKode);
                            }

				 		$jum = $jumlah->status!=false?count($jumlah->data ):'';

				 	}

			 }

			 if (($jenis == 'penelitian') or ($jenis == 'PM') ){
				 if ($linktahun == false){
				 	$config['base_url'] = site_url('publikasi/publikasi/'.$jenbkd.'/'.$data['tahun'].'/');
				 }else{
				 	$config['base_url'] = site_url('publikasi/publikasi/'.$jenbkd.'/'.$linktahun.'/');
				 }
			}else{
				if ($exjenisp[0] =='%'){
					$exjenisp[0] = '';
				}else{
					$exjenisp[0] = $exjenisp[0];
				}
				 if ($linktahun == false){
				 	
				 	$config['base_url'] = site_url('publikasi/publikasi/'.$jenbkd.'/'.$data['tahun'].'-'.$exjenisp[0].'/');
				 }else{
				 	$config['base_url'] = site_url('publikasi/publikasi/'.$jenbkd.'/'.$linktahun.'-'.$exjenisp[0].'/');
				 }

			}

	    $config['total_rows'] =  $jum;
		$config['per_page'] = $perpage;
		$config['full_tag_open']    = '<ul class="pagination">';
		$config['full_tag_close']   = '</ul>';
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['first_tag_open']   = '<li class="page-item page-link">';
		$config['first_tag_close']  = '</li>';
		$config['prev_link']        = '&laquo';
		$config['prev_tag_open']    = '<li class="page-item page-link">';
		$config['prev_tag_close']   = '</li>';
		$config['next_link']        = '&raquo';
		$config['next_tag_open']    = '<li class="page-item page-link">';
		$config['next_tag_close']   = '</li>';
		$config['last_tag_open']    = '<li class="page-item page-link">';
		$config['last_tag_close']   = '</li>';
		$config['cur_tag_open']     = '<li class="active"><a href="" class="page-link">';
		$config['cur_tag_close']    = '</a></li>';
		$config['num_tag_open']     = '<li class="page-item page-link">';
		$config['num_tag_close']    = '</li>';
     	$this->pagination->initialize($config);
        $data['offset'] =$offset;
        $data['pages'] = 'page/publikasi/view';
        $data['datas'] = false;
		$data['kategori'] = $this->model_konten->get_kategori(3);
		$data['kategoriiku'] = $this->model_konten->get_ref_table('ref_kategori_konten','kategoriId');
		$data['publikasi'] = $this->model_konten->get_ref_table('ref_kategori_publikasi ', 'publikasiId');
        // $data['menu'] = menu();
        $data['search_url'] = site_url('page/searchpost') . '/';
        $data['is_active'] = '';
        $data['searchpublikasi_url'] = site_url('Publikasi/publikasi/').$jenis.'/';
        $this->load->view('page/template', $data);
    }
}