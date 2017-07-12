<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imageinfo {

    public $return_data;

    public function __construct()
    {

        $url = ee()->TMPL->fetch_param('url');
    
        if(is_null($url) || empty($url))
        {
            return FALSE;
        }

        $parsed = parse_url($url);

        $test = get_headers($url);

        if(!strpos($test[0],"200"))
        {
            return FALSE;
        }

        $file = $_SERVER['DOCUMENT_ROOT'];

        if(!file_exists($file.$parsed['path']))
        {
            return FALSE;
        }

        $imageinfo = getimagesize($file.$parsed['path']);

        $variables = array(
            'width' => $imageinfo[0],
            'height' => $imageinfo[1]
        );

        $this->return_data = ee()->TMPL->parse_variables_row(ee()->TMPL->tagdata, $variables);

        return $this->return_data;

    }

}