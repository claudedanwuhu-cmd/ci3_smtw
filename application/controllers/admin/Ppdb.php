<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppdb extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'PPDB';
        $data['ppdb'] = $this->db->order_by('id', 'DESC')->get('ppdb')->result();

        $this->load->view('admin/ppdb/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah PPDB';
        $this->load->view('admin/ppdb/tambah', $data);
    }

    public function simpan()
    {
        $data = $this->input->post(NULL, TRUE);
        $data['created_at'] = date('Y-m-d H:i:s');

        $this->db->insert('ppdb', $data);

        $this->session->set_flashdata('success', 'Data PPDB berhasil ditambahkan.');
        redirect('admin/ppdb');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit PPDB';
        $data['ppdb'] = $this->db->where('id', $id)->get('ppdb')->row();

        if (!$data['ppdb']) {
            show_404();
        }

        $this->load->view('admin/ppdb/edit', $data);
    }

    public function update($id)
    {
        $data = $this->input->post(NULL, TRUE);

        $this->db->where('id', $id)->update('ppdb', $data);

        $this->session->set_flashdata('success', 'Data PPDB berhasil diperbarui.');
        redirect('admin/ppdb');
    }

    public function hapus($id)
    {
        $this->db->where('id', $id)->delete('ppdb');

        $this->session->set_flashdata('success', 'Data PPDB berhasil dihapus.');
        redirect('admin/ppdb');
    }
}
