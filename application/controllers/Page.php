<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

class Page extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_menu', '', TRUE);
        $this->_model = 'model_konten';
        $this->load->model($this->_model, '', TRUE);
    }

    public function index() //single post page
    {
        $konten = $_GET['content'];
        $data = $this->get_master();
        if ($konten != false) {
            $pageNama = preg_replace('/[^A-Za-z0-9\.]/', '', strip_tags($konten));
            $data['datas'] = $this->model_konten->get_by_id('f_page', '(pageNamaID="' . $pageNama . '" or pageNamaEN="' . $pageNama . '") and pageTemaId="' . $data['master']->temaId . '"');
            $data['pengumuman'] = $this->model_konten->get_konten('pengumuman', $data['master']->temaId, 5);
            $data['terbaru'] = $this->model_konten->get_terbaru($data['master']->temaId, 5);
            $data['pin'] = $this->model_konten->get_konten_pin('berita', $data['master']->temaId, 5);
            $data['kategori'] = $this->model_konten->get_kategori(3);
		    $data['kategoriiku'] = $this->model_konten->get_ref_table('ref_kategori_konten','kategoriId');
            $data['publikasi'] = $this->model_konten->get_ref_table('ref_kategori_publikasi ', 'publikasiId');
            $data['search_url'] = site_url('page/searchpost') . '/';
            $data['is_active'] = ucwords($data['datas'] != false ? $data['datas']->{'pageJudul' . $data['lang']} : $pageNama);
            $data['pages'] = 'page/konten/post';
            $this->load->view('page/template', $data);
        } else {
            redirect('beranda');
        }
    }

    public function list() //single post page
    {
        $page = $this->uri->segment(3);
        $this->load->helper('datetoindo');
        $data = $this->get_master();
        $data['pengumuman'] = $this->model_konten->get_konten('pengumuman', $data['master']->temaId, 5);
        $data['terbaru'] = $this->model_konten->get_terbaru($data['master']->temaId, 5);
        $data['pin'] = $this->model_konten->get_konten_pin('berita', $data['master']->temaId, 5);
        $data['kategori'] = $this->model_konten->get_kategori(3);
		$data['kategoriiku'] = $this->model_konten->get_ref_table('ref_kategori_konten','kategoriId');
        $data['publikasi'] = $this->model_konten->get_ref_table('ref_kategori_publikasi ', 'publikasiId');
        $data['list'] = $this->model_konten->getAll($page, $data['master']->temaId);
        $data['keyword'] = false;
        $getkategori = $this->model_konten->get_by_id('ref_kategori_konten ', 'kategoriNama="' . $page . '"');
        $data['is_active'] = ucwords($getkategori->{'kategoriKet' . $data['lang']});
        $perpage = 9;
        $offset = $this->uri->segment(4);
        $data['konten'] = $this->model_konten->getDataPagination($perpage, $offset, $page, $data['master']->temaId);
        $config['base_url'] = site_url('page/list/' . $page . '/');
        $config['total_rows'] = $this->model_konten->getAll($page, $data['master']->temaId);
        $config['per_page'] = $perpage;
        $config['full_tag_open']    = '<ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '&laquo';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '&raquo';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['attributes']       = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $data['search_url'] = site_url('page/searchpost') . '/';
        $data['slider'] = $this->{$this->_model}->get_ref_table('f_slider', '', ['sliderIsDisplay' => 1]);
        $data['pages'] = 'page/konten/list';
        $this->load->view('page/template', $data);
    }

    public function detail($kontenNama) //single post page
    {
        $data = $this->get_master();
        $data['pengumuman'] = $this->model_konten->get_konten('pengumuman', $data['master']->temaId, 5);
        $data['terbaru'] = $this->model_konten->get_terbaru($data['master']->temaId, 5);
        $data['pin'] = $this->model_konten->get_konten_pin('berita', $data['master']->temaId, 5);
        $datas = $this->model_konten->get_by_id('f_konten', '(kontenNamaID="' . $kontenNama . '" or kontenNamaEN="' . $kontenNama . '")');
        $datas->pageSidebar = false;
        $data['datas'] = $datas;
        $data['search_url'] = site_url('page/searchpost') . '/';
        $kategori = $this->model_konten->get_by_id('ref_kategori_konten ', 'kategoriId="' . $datas->kontenKategoriId . '"');
        $data['kategori'] = $this->model_konten->get_kategori(3);
		$data['kategoriiku'] = $this->model_konten->get_ref_table('ref_kategori_konten','kategoriId');
        $data['publikasi'] = $this->model_konten->get_ref_table('ref_kategori_publikasi ', 'publikasiId');
        $data['is_active'] = ucwords($kategori != false ? $kategori->{'kategoriKet' . $data['lang']} : '');
        $related = $this->model_konten->get_konten('berita', $data['master']->temaId, 7);
        if ($related !== false) {
            $filtered = array_filter($related, function ($item) use ($kontenNama) {
                return ($item->kontenNamaID !== $kontenNama && $item->kontenNamaEN !== $kontenNama);
            });
            $data['related'] = array_slice(array_values($filtered), 0, 6);
        } else {
            $data['related'] = false;
        }
        $data['pages'] = 'page/konten/detail';
        $this->load->view('page/template', $data);
    }

    public function searchpost()
    {
        $data = $this->get_master();
        $keyword = $this->input->post('keyword', true);
        $this->session->keyword = $keyword;
        // print_r($keyword);
        // exit;
        // if ($keyword == NULL) {
        //     redirect('beranda');
        // }
        $data['keyword'] = $keyword;
        $data['pages'] = 'page/konten/search';
        $data['search_url'] = site_url('page/searchpost') . '/';
        $data['datasearch'] = $this->model_konten->cari_konten($keyword, $data['master']->temaId);
        $data['pengumuman'] = $this->model_konten->get_konten('pengumuman', $data['master']->temaId, 5);
        $data['terbaru'] = $this->model_konten->get_terbaru($data['master']->temaId, 5);
        $data['pin'] = $this->model_konten->get_konten_pin('berita', $data['master']->temaId, 5);
        $kategori = $this->model_konten->get_by_id('ref_kategori_konten ', 'kategoriId');
        $data['is_active'] = 'Informasi';
        $data['kategori'] = $this->model_konten->get_kategori(3);
		$data['kategoriiku'] = $this->model_konten->get_ref_table('ref_kategori_konten','kategoriId');
        $data['publikasi'] = $this->model_konten->get_ref_table('ref_kategori_publikasi ', 'publikasiId');
        $this->load->view('page/template', $data);
    }

    public function loadattach()
    {
        ob_clean();
        $this->load->helper('file');
        $file = $this->uri->segment(3);
        $path = FCPATH . '../upload_file/files/' . $file;
        $files = get_mime_by_extension($path);
        // echo $files;
        // exit();
        if ($files == 'application/pdf') {
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $path . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($path);
        } elseif ($files == 'application/msword') {
            header('Content-type: application/msword');
            header('Content-Disposition: attachment; filename="' . $file . '"');
            readfile($path);
        } elseif ($files == 'application/vnd.ms-excel') {
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="' . $file . '"');
            readfile($path);
        } elseif ($files == 'application/vnd.ms-powerpoint') {
            header('Content-type: application/vnd.ms-powerpoint');
            header('Content-Disposition: attachment; filename="' . $file . '"');
            readfile($path);
        } elseif ($files == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Content-Disposition: attachment; filename="' . $file . '"');
            readfile($path);
        } elseif ($files == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . $file . '"');
            readfile($path);
        } elseif ($files == 'application/vnd.openxmlformats-officedocument.presentationml.presentation') {
            header('Content-type: application/vnd.openxmlformats-officedocument.presentationml.presentation');
            header('Content-Disposition: attachment; filename="' . $file . '"');
            readfile($path);
        } else {
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

    public function loadthumb()
    {
        $file = $this->uri->segment(3);
        ob_clean();
        $path = FCPATH . '../upload_file/berita/thumb/' . $file;
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
