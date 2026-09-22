<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekstrakurikuler extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'Ekstrakurikuler';
        $data['ekstrakurikuler'] = $this->db->order_by('id', 'DESC')->get('ekstrakurikuler')->result();

        $this->load->view('admin/ekstrakurikuler/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Ekstrakurikuler';
        $this->load->view('admin/ekstrakurikuler/tambah', $data);
    }

    public function simpan()
    {
        $foto = $this->upload_foto();
        if ($foto === FALSE) {
            redirect('admin/ekstrakurikuler/tambah');
        }

        $data = array(
            'nama' => $this->input->post('nama', TRUE),
            'pembina' => $this->input->post('pembina', TRUE),
            'jadwal' => $this->input->post('jadwal', TRUE),
            'tempat' => $this->input->post('tempat', TRUE),
            'status' => $this->input->post('status', TRUE),
            'foto' => $foto,
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('ekstrakurikuler', $data);

        $this->session->set_flashdata('success', 'Ekstrakurikuler berhasil ditambahkan.');
        redirect('admin/ekstrakurikuler');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Ekstrakurikuler';
        $data['ekstrakurikuler'] = $this->db->where('id', $id)->get('ekstrakurikuler')->row();

        if (!$data['ekstrakurikuler']) {
            show_404();
        }

        $this->load->view('admin/ekstrakurikuler/edit', $data);
    }

    public function update($id)
    {
        $ekstrakurikuler = $this->db->where('id', (int) $id)->get('ekstrakurikuler')->row();
        if (!$ekstrakurikuler) {
            show_404();
        }

        $foto = $this->upload_foto();
        if ($foto === FALSE) {
            redirect('admin/ekstrakurikuler/edit/' . $id);
        }

        $data = array(
            'nama' => $this->input->post('nama', TRUE),
            'pembina' => $this->input->post('pembina', TRUE),
            'jadwal' => $this->input->post('jadwal', TRUE),
            'tempat' => $this->input->post('tempat', TRUE),
            'status' => $this->input->post('status', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE)
        );

        if ($foto !== NULL) {
            $data['foto'] = $foto;
        }

        $this->db->where('id', $id)->update('ekstrakurikuler', $data);

        if ($foto !== NULL) {
            $this->hapus_foto($ekstrakurikuler->foto);
        }

        $this->session->set_flashdata('success', 'Ekstrakurikuler berhasil diperbarui.');
        redirect('admin/ekstrakurikuler');
    }

    public function hapus($id)
    {
        $ekstrakurikuler = $this->db->where('id', (int) $id)->get('ekstrakurikuler')->row();
        $this->db->where('id', $id)->delete('ekstrakurikuler');

        if ($ekstrakurikuler) {
            $this->hapus_foto($ekstrakurikuler->foto);
        }

        $this->session->set_flashdata('success', 'Ekstrakurikuler berhasil dihapus.');
        redirect('admin/ekstrakurikuler');
    }

    private function upload_foto()
    {
        if (empty($_FILES['foto']['name'])) {
            return NULL;
        }

        $upload_path = FCPATH . 'uploads/ekstrakurikuler/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
            $this->session->set_flashdata('error', 'Folder upload foto ekstrakurikuler tidak dapat dibuat.');
            return FALSE;
        }

        $this->load->library('upload');
        $this->upload->initialize(array(
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp|avif',
            'max_size' => 10240,
            'encrypt_name' => TRUE
        ));

        if (!$this->upload->do_upload('foto')) {
            $this->session->set_flashdata('error', strip_tags($this->upload->display_errors('', '')));
            return FALSE;
        }

        return $this->upload->data('file_name');
    }

    private function hapus_foto($foto)
    {
        if (!$foto || strpos($foto, '/') !== FALSE || strpos($foto, '\\') !== FALSE) {
            return;
        }

        $file = FCPATH . 'uploads/ekstrakurikuler/' . basename($foto);
        if (is_file($file)) {
            unlink($file);
        }
    }
}
