<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'Guru & Staff';
        $data['guru'] = $this->db->order_by('id', 'DESC')->get('guru')->result();

        $this->load->view('admin/guru/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Guru';
        $this->load->view('admin/guru/tambah', $data);
    }

    public function simpan()
    {
        $foto = $this->upload_foto();
        if ($foto === FALSE) {
            redirect('admin/guru/tambah');
        }

        $data = array(
            'nama'           => $this->input->post('nama', TRUE),
            'nip'            => $this->input->post('nip', TRUE),
            'nuptk'          => $this->input->post('nuptk', TRUE),
            'jenis_kelamin'  => $this->input->post('jenis_kelamin', TRUE),
            'jabatan'        => $this->input->post('jabatan', TRUE),
            'mata_pelajaran' => $this->input->post('mata_pelajaran', TRUE),
            'foto'           => $foto,
            'deskripsi'      => $this->input->post('deskripsi', TRUE),
            'status'         => $this->input->post('status', TRUE),
            'created_at'     => date('Y-m-d H:i:s')
        );

        $this->db->insert('guru', $data);

        $this->session->set_flashdata('success', 'Data guru berhasil ditambahkan.');
        redirect('admin/guru');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Guru';
        $data['guru'] = $this->db->where('id', $id)->get('guru')->row();

        if (!$data['guru']) {
            show_404();
        }

        $this->load->view('admin/guru/edit', $data);
    }

    public function update($id)
    {
        $guru = $this->db->where('id', (int) $id)->get('guru')->row();
        if (!$guru) {
            show_404();
        }

        $foto = $this->upload_foto();
        if ($foto === FALSE) {
            redirect('admin/guru/edit/' . $id);
        }

        $data = array(
            'nama'           => $this->input->post('nama', TRUE),
            'nip'            => $this->input->post('nip', TRUE),
            'nuptk'          => $this->input->post('nuptk', TRUE),
            'jenis_kelamin'  => $this->input->post('jenis_kelamin', TRUE),
            'jabatan'        => $this->input->post('jabatan', TRUE),
            'mata_pelajaran' => $this->input->post('mata_pelajaran', TRUE),
            'deskripsi'      => $this->input->post('deskripsi', TRUE),
            'status'         => $this->input->post('status', TRUE)
        );

        if ($foto !== NULL) {
            $data['foto'] = $foto;
        }

        $this->db->where('id', $id)->update('guru', $data);

        if ($foto !== NULL) {
            $this->hapus_foto($guru->foto);
        }

        $this->session->set_flashdata('success', 'Data guru berhasil diperbarui.');
        redirect('admin/guru');
    }

    public function hapus($id)
    {
        $guru = $this->db->where('id', (int) $id)->get('guru')->row();
        $this->db->where('id', $id)->delete('guru');

        if ($guru) {
            $this->hapus_foto($guru->foto);
        }

        $this->session->set_flashdata('success', 'Data guru berhasil dihapus.');
        redirect('admin/guru');
    }

    private function upload_foto()
    {
        if (empty($_FILES['foto']['name'])) {
            return NULL;
        }

        $upload_path = FCPATH . 'assets/img/guru/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
            $this->session->set_flashdata('error', 'Folder upload foto guru tidak dapat dibuat.');
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

        return 'guru/' . $this->upload->data('file_name');
    }

    private function hapus_foto($foto)
    {
        if (!$foto || strpos($foto, 'guru/') !== 0) {
            return;
        }

        $file = FCPATH . 'assets/img/' . $foto;
        if (is_file($file)) {
            unlink($file);
        }
    }
}
