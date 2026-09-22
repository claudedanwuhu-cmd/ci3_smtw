<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'Fasilitas';
        $data['fasilitas'] = $this->db->order_by('id', 'DESC')->get('fasilitas')->result();

        $this->load->view('admin/fasilitas/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Fasilitas';
        $this->load->view('admin/fasilitas/tambah', $data);
    }

    public function simpan()
    {
        $foto = $this->upload_foto();
        if ($foto === FALSE) {
            redirect('admin/fasilitas/tambah');
        }

        $data = array(
            'nama_fasilitas' => $this->input->post('nama_fasilitas', TRUE),
            'foto' => $foto,
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'status' => $this->input->post('status', TRUE),
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('fasilitas', $data);

        $this->session->set_flashdata('success', 'Fasilitas berhasil ditambahkan.');
        redirect('admin/fasilitas');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Fasilitas';
        $data['fasilitas'] = $this->db->where('id', $id)->get('fasilitas')->row();

        if (!$data['fasilitas']) {
            show_404();
        }

        $this->load->view('admin/fasilitas/edit', $data);
    }

    public function update($id)
    {
        $fasilitas = $this->db->where('id', (int) $id)->get('fasilitas')->row();
        if (!$fasilitas) {
            show_404();
        }

        $foto = $this->upload_foto();
        if ($foto === FALSE) {
            redirect('admin/fasilitas/edit/' . $id);
        }

        $data = array(
            'nama_fasilitas' => $this->input->post('nama_fasilitas', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'status' => $this->input->post('status', TRUE)
        );

        if ($foto !== NULL) {
            $data['foto'] = $foto;
        }

        $this->db->where('id', $id)->update('fasilitas', $data);

        if ($foto !== NULL) {
            $this->hapus_foto($fasilitas->foto);
        }

        $this->session->set_flashdata('success', 'Fasilitas berhasil diperbarui.');
        redirect('admin/fasilitas');
    }

    public function hapus($id)
    {
        $fasilitas = $this->db->where('id', (int) $id)->get('fasilitas')->row();
        $this->db->where('id', $id)->delete('fasilitas');

        if ($fasilitas) {
            $this->hapus_foto($fasilitas->foto);
        }

        $this->session->set_flashdata('success', 'Fasilitas berhasil dihapus.');
        redirect('admin/fasilitas');
    }

    private function upload_foto()
    {
        if (empty($_FILES['foto']['name'])) {
            return NULL;
        }

        $upload_path = FCPATH . 'assets/img/fasilitas/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
            $this->session->set_flashdata('error', 'Folder upload foto fasilitas tidak dapat dibuat.');
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

        $file = FCPATH . 'assets/img/fasilitas/' . basename($foto);
        if (is_file($file)) {
            unlink($file);
        }
    }
}
