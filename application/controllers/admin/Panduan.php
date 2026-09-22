<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panduan extends Admin_Controller
{
    public function index()
    {
        $data['title'] = 'Panduan Web';
        $this->load->view('admin/panduan', $data);
    }
}