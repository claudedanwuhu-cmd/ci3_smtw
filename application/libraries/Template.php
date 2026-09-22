<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {

    var $template_data = array();

    function set($name, $value)
    {
        $this->template_data[$name] = $value;
    }

    function load($template = '', $view = '', $view_data = array(), $return = FALSE)
    {
        $CI =& get_instance();
        
        // Memuat konten view dinamis dan memasukkannya ke dalam variabel $contents
        $this->set('contens', $CI->load->view($view, $view_data, TRUE));
        
        // Memuat master template utama dengan membawa data konten tersebut
        return $CI->load->view($template, $this->template_data, $return);
    }

}