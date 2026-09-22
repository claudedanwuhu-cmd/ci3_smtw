<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'Pengumuman';
        $data['pengumuman'] = $this->db->order_by('id', 'DESC')->get('pengumuman')->result();

        $this->load->view('admin/pengumuman/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Pengumuman';
        $this->load->view('admin/pengumuman/tambah', $data);
    }

    public function simpan()
    {
        $data = $this->input->post(NULL, TRUE);
        $data['status'] = $data['status'] === 'nonaktif' ? 'draft' : 'publish';
        $data['user_id'] = $this->session->userdata('user_id');
        $data['created_at'] = date('Y-m-d H:i:s');

        $this->db->insert('pengumuman', $data);

        $this->session->set_flashdata('success', 'Pengumuman berhasil ditambahkan.');
        redirect('admin/pengumuman');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Pengumuman';
        $data['pengumuman'] = $this->db->where('id', $id)->get('pengumuman')->row();

        if (!$data['pengumuman']) {
            show_404();
        }

        $this->load->view('admin/pengumuman/edit', $data);
    }

    public function update($id)
    {
        $data = $this->input->post(NULL, TRUE);
        $data['status'] = $data['status'] === 'nonaktif' ? 'draft' : 'publish';

        $this->db->where('id', $id)->update('pengumuman', $data);

        $this->session->set_flashdata('success', 'Pengumuman berhasil diperbarui.');
        redirect('admin/pengumuman');
    }

    public function hapus($id)
    {
        $this->db->where('id', $id)->delete('pengumuman');

        $this->session->set_flashdata('success', 'Pengumuman berhasil dihapus.');
        redirect('admin/pengumuman');
    }
}
