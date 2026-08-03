<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('uploadfile'))
{
    function uploadfile($konfig,$model) 
    {
        $config['upload_path'] = $konfig['url']; //path folder
        $config['allowed_types'] = $konfig['type']; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = $konfig['size']; //maksimum besar file 15M
        $config['file_name'] = $konfig['namafile']; //nama yang terupload nantinya

        $CI = get_instance();

        if (!file_exists($konfig['url']))
            mkdir($konfig['url'], 0755, true);

        if (!empty($filename)) {
            if (file_exists($konfig['url'] . $konfig['namafile']))
                @unlink($konfig['url'] . $konfig['namafile']);
        }
        $CI->load->library('upload', $config);
        if (!$CI->upload->do_upload($konfig['name']))
            echo message(strip_tags($CI->upload->display_errors()), 'error');
        else {
            $file = $CI->upload->data();

            return $file;
        }       
	}
}
