<?php

namespace app\Libraries;

class Builder
{
    public $js = array();
    public $css = array();
    public $regions = array(
      'head_scripts' => array(),
      'head_styles' => array(),
      'body_scripts' => array(),
    );

    public function add_js($script, $module = null, $position = 'body', $defer = false)
    {
        $js = '';

        $dir = url('/') .'/public/js/';
        $external = preg_match("/^http/i", $script) || preg_match("/^\/\//i", $script);

        if (!$external && !preg_match("/\.js/i", $script)) {
            $script .= '.js';
        }

        if ($external) {
            $url = $script;
        } else {
            if (file_exists($dir . $script)) {
                $url = $dir . $script;
                // $url = $dir . $script . '?v=1.0';
            }
        }

        if (isset($url)) {
            $js = ('<script type="text/javascript" src="'. $url .'"></script>');
        }

        // echo '<pre>';die(var_dump($js));
       // Add to js array if it doesn't already exist
        // if ($js != null && !in_array($js, $this->js)) {
        if ($js != '') {
            $this->js[] = $js;
            if ($position == 'body') {
        echo '<pre>';die(var_dump($js));
                $this->write('body_scripts', $js, false);
            } else {
                $this->write('head_scripts', $js, false);
            }
        }

        return $this;
    }

    public function add_css($style, $module = '', $media = false)
    {
        $css = null;

        $this->CI->load->helper('url');
        $dir = APPPATH . 'modules/' . (($module) ? $module.'/' : $this->module) . $this->module_assets;

        $external = preg_match("/^http/i", $style) || preg_match("/^\/\//i", $style);

        if (!$external && !preg_match("/\.css/i", $style)) {
            $style .= '.css';
        }

        if ($external) {
            $url = $style;
        } elseif (file_exists($dir . $style)) {
            $url = base_url() . $dir . $style . '?v='.$this->CI->config->item('version');
        }

        if (isset($url)) {
            $css = '<link type="text/css" rel="stylesheet" href="'. $url .'"';
            if ($media) {
                $css .= ' media="'. $media .'"';
            }
            $css .= ' />';
        }

       // Add to css array if it doesn't already exist
        if ($css != null && !in_array($css, $this->css)) {
            $this->css[] = $css;
            $this->write('head_styles', $css, false);
        }

        return $this;
    }

    public function write($region, $content, $overwrite = true, $prepend = false)
    {
        //CONTINUAR DAQUI
        if($prepend){
            $this->arrMeta[] = '';
        }

        if (isset($this->regions[$region])) {
            if ($overwrite === true) { // Should we append the content or overwrite it
                $this->regions[$region]['content'] = array($content);
            } else {
                if ($prepend === false) { // Should we append the content or preppend it
                    $this->regions[$region]['content'][] = $content;
                } else {
                    array_unshift($this->regions[$region]['content'], $content);
                }
            }
        } // Regions MUST be defined
        else {
            show_error("Cannot write to the '{$region}' region. The region is undefined.");
        }

       //Magic for $this->template->function1->function2
        return $this;
    }
}