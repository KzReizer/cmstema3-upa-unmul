<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

class konten extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->_controller_name = 'konten';
		$this->_model = 'model_f_master';
		$this->load->model('model_konten','',TRUE);
		$this->load->model($this->_model, '', TRUE);
	}

	public function index()
	{	
		$this->load->helper('datetoindo');
		$data['datas'] = false;
    	$data['agenda'] = $this->model_konten->get_konten('Agenda',5);
		$data['terbaru'] = $this->model_konten->get_terbaru($data['master']->temaId, 5);
		$data['is_active'] = 'konten';	
		$data['pages'] = 'page/konten/view';
		$domain=$_SERVER['SERVER_NAME'];
		$tema = $this->{$this->_model}->get_by_id('s_tema',['temaDomain'=>$domain]);
		$data['tema'] = $tema;
        $data['publikasi'] = $this->model_konten->get_ref_table('ref_kategori_publikasi ', 'publikasiId');
		$data['data'] = $this->model_konten->get(5);
		$data['all'] = $this->model_konten->get(5);
		$data['pin'] = $this->model_konten->get_konten_pin(5);
		$perpage = 5;
	    $offset = $this->uri->segment(3);
	    $data['konten'] =$this->model_konten->getDataPagination($perpage, $offset,'konten')->result();
	    $config['base_url'] = site_url('konten/index/');
	    $config['total_rows'] = $this->model_konten->getAll('konten')->num_rows();
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
		$data['search_url'] = site_url('f_home/searchpost').'/';
		$data['keyword'] = FALSE;
        $data['menu'] = menu();
		$this->load->view('page/template', $data);
	}

	public function post($kategori,$kontenNama)//single post page
    {
    	$this->load->helper('datetoindo');
    	$data['datas'] = false;
    	$data['agenda'] = $this->model_konten->get_konten('Agenda',5);
		$data['terbaru'] = $this->model_konten->get_terbaru($data['master']->temaId, 5);
		$data['is_active'] = 'konten';
        $data['pages'] = 'page/konten/post';
        $data['data'] = $this->model_konten->get(5);
		$data['dataskonten'] = $this->model_konten->get_nama($kontenNama);
		$data['all'] = $this->model_konten->get(5);
		$data['pin'] = $this->model_konten->get_konten_pin(5);
		$data['keyword'] = FALSE;
		$data['search_url'] = site_url($this->_controller_name.'/searchpost').'/';
		$data['footer'] = $this->{$this->_model}->get_by_id('f_footer',['footId'=>1]);
        $data['menu'] = menu();
        $this->load->view('page/template', $data);
	}

	public function loadimage()
	{
		$file = $this->uri->segment(3);
		ob_clean();
		$path = FCPATH . '../upload_file/konten/'. $file;
		$size = getimagesize($path);
		header('Content-Type:' . $size['mime']);
		switch ($size['mime']) {
			case 'image/png':
			$img = imagecreatefrompng($path);

			imagepng($img);
			break;

			default:
			$img = imagecreatefromjpeg($path);
			imagejpeg($img);
			break;
		}
		imagedestroy($img);
	}
	
	public function loadthumb()
	{
		$file = $this->uri->segment(3);
		ob_clean();
		$path = FCPATH . '../upload_file/konten/thumb/'. $file;
		$size = getimagesize($path);
		header('Content-Type:' . $size['mime']);
		switch ($size['mime']) {
			case 'image/png':
			$img = imagecreatefrompng($path);

			imagepng($img);
			break;

			default:
			$img = imagecreatefromjpeg($path);
			imagejpeg($img);
			break;
		}
		imagedestroy($img);
	}

	
}