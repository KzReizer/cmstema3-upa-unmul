<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class beranda extends MY_Controller{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->_controller_name = 'Beranda';
		$this->_model = 'model_konten';
		$this->_path_js = 'beranda';
		$this->load->model($this->_model, '', TRUE);
	}

	public function index()
	{
		$data                = $this->get_master();
		$data['is_active']   = 'Beranda';
		$data['stat']        = $this->model_konten->get_statistik($data['master']->temaId, 4);
		$data['slider']      = $this->model_konten->get_slider($data['master']->temaId, 3);
		$data['logounit']    = $this->model_konten->get_logounit($data['master']->temaId, 1);
		$data['explore']     = $this->model_konten->get_explore($data['master']->temaId);
		$data['logo']        = $this->model_konten->get_logo($data['master']->temaId);
		$data['quote']       = $this->model_konten->get_quote($data['master']->temaId, 3);
		$data['berita']      = $this->model_konten->get_konten('berita',$data['master']->temaId,4);
		$data['kategori']    = $this->model_konten->get_kategori(3);
		$data['kategoriiku'] = $this->model_konten->get_ref_table('ref_kategori_konten','kategoriId');
		$data['publikasi']   = $this->model_konten->get_ref_table('ref_kategori_publikasi','publikasiId');
		$data['search_url']  = site_url('page/searchpost').'/';
		$data['scripts']     = [($this->_controller_name)];

		$this->load->view('front/home/template', $data);
	}

	public function switchlang()
	{		
		$lang=$this->input->post('lang');						
		$this->session->set_userdata('bahasa',$lang);
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

	public function load_content()
	{
		$file = $this->uri->segment(3);
		ob_clean();
		$path = FCPATH . '../upload_file/content/'. $file;
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

	public function loadslider()
	{
		$file = $this->uri->segment(3);
		ob_clean();
		$path = FCPATH . '../upload_file/files/'. $file;
		$files = pathinfo($path, PATHINFO_EXTENSION);
		if ($files == 'mp4') {
            header('Content-type: video/mp4');
            header('Content-Disposition: inline; filename="' . $path . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($path);

        }   elseif ($files == 'x-flv') {
            header('Content-type: video/x-flv');
            header('Content-Disposition: inline; filename="' . $path . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($path);

        }   else {

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
}
