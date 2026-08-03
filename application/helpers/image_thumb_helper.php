<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if(!function_exists('image_thumb'))
{
    function image_thumb($folder_name, $image_name, $width, $height)
    {
        // Get the CodeIgniter super object
        $CI =& get_instance();
        // Path to image thumbnail
        $image_thumb = dirname($folder_name.'/thumb/'.$image_name).'/'.$image_name;
        // print_r($image_thumb);
        if( ! file_exists($image_thumb))
        {
            // LOAD LIBRARY
            $CI->load->library('image_lib');
     
            // CONFIGURE IMAGE LIBRARY
            $config['image_library']    = 'gd2';
            $config['source_image']     = $folder_name.'/'.$image_name;
            $config['new_image']        = $image_thumb;
            $config['maintain_ratio']   = TRUE;
            // $config['height']           = $height;
            $config['width']            = $width;

            $CI->image_lib->initialize($config);
            $CI->image_lib->resize();
            $CI->image_lib->clear();

            $config['image_library']    = 'gd2';
            $config['source_image']     = $image_thumb;
            $config['maintain_ratio']   = FALSE;
            $config['height']           = $height;
            $config['width']            = $width;

            $CI->image_lib->initialize($config);
            $CI->image_lib->crop();
            $CI->image_lib->clear();
        }
     
        // return '<img src="' . dirname($_SERVER['SCRIPT_NAME']) . '/' . $image_thumb . '" />';
    }
}
 
 
/* End of file image_helper.php */
/* Location: system/application/helpers/image_helper.php */