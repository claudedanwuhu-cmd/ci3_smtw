<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'Agenda';
        $data['agenda'] = $this->db->order_by('tanggal', 'DESC')->get('agenda')->result();

        $this->load->view('admin/agenda/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Agenda';
        $this->load->view('admin/agenda/tambah', $data);
    }

    public function simpan()
    {
        $data = $this->input->post(NULL, TRUE);
        $data['user_id'] = $this->session->userdata('user_id');
        $data['created_at'] = date('Y-m-d H:i:s');

        $this->db->insert('agenda', $data);

        $this->session->set_flashdata('success', 'Agenda berhasil ditambahkan.');
        redirect('admin/agenda');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Agenda';
        $data['agenda'] = $this->db->where('id', $id)->get('agenda')->row();

        if (!$data['agenda']) {
            show_404();
        }

        $this->load->view('admin/agenda/edit', $data);
    }

    public function update($id)
    {
        $data = $this->input->post(NULL, TRUE);

        $this->db->where('id', $id)->update('agenda', $data);

        $this->session->set_flashdata('success', 'Agenda berhasil diperbarui.');
        redirect('admin/agenda');
    }

    public function hapus($id)
    {
        $this->db->where('id', $id)->delete('agenda');

        $this->session->set_flashdata('success', 'Agenda berhasil dihapus.');
        redirect('admin/agenda');
    }
}
