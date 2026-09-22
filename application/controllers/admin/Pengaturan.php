<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));

        $this->hanya_admin();
    }

    public function index()
    {
        $data['title'] = 'Pengaturan Website';
        $data['pengaturan'] = $this->db->get('pengaturan')->row();

        $this->load->view('admin/pengaturan/index', $data);
    }

    public function update()
    {
        $data = $this->input->post(NULL, TRUE);

        $this->db->update('pengaturan', $data);

        $this->session->set_flashdata('success', 'Pengaturan berhasil diperbarui.');
        redirect('admin/pengaturan');
    }
}
