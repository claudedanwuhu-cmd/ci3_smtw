<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'Prestasi';
        $data['prestasi'] = $this->db->order_by('id', 'DESC')->get('prestasi')->result();

        $this->load->view('admin/prestasi/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Prestasi';
        $this->load->view('admin/prestasi/tambah', $data);
    }

    public function simpan()
    {
        $data = $this->prestasi_data();
        $data['created_at'] = date('Y-m-d H:i:s');

        $foto = $this->upload_foto();
        if ($foto === FALSE) {
            redirect('admin/prestasi/tambah');
        }
        if ($foto !== NULL) {
            $data['foto'] = $foto;
        }

        if (!$this->db->insert('prestasi', $data)) {
            $this->session->set_flashdata('error', 'Prestasi gagal ditambahkan.');
            redirect('admin/prestasi/tambah');
        }

        $this->session->set_flashdata('success', 'Prestasi berhasil ditambahkan.');
        redirect('admin/prestasi');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Prestasi';
        $data['prestasi'] = $this->db->where('id', $id)->get('prestasi')->row();

        if (!$data['prestasi']) {
            show_404();
        }

        $this->load->view('admin/prestasi/edit', $data);
    }

    public function update($id)
    {
        $prestasi = $this->db->where('id', (int) $id)->get('prestasi')->row();
        if (!$prestasi) {
            show_404();
        }

        $data = $this->prestasi_data();
        $foto = $this->upload_foto();
        if ($foto === FALSE) {
            redirect('admin/prestasi/edit/' . $id);
        }
        if ($foto !== NULL) {
            $data['foto'] = $foto;
        }

        if (!$this->db->where('id', (int) $id)->update('prestasi', $data)) {
            $this->session->set_flashdata('error', 'Prestasi gagal diperbarui.');
            redirect('admin/prestasi/edit/' . $id);
        }

        $this->session->set_flashdata('success', 'Prestasi berhasil diperbarui.');
        redirect('admin/prestasi');
    }

    public function hapus($id)
    {
        if (!$this->db->where('id', (int) $id)->delete('prestasi')) {
            $this->session->set_flashdata('error', 'Prestasi gagal dihapus.');
            redirect('admin/prestasi');
        }

        $this->session->set_flashdata('success', 'Prestasi berhasil dihapus.');
        redirect('admin/prestasi');
    }

    private function prestasi_data()
    {
        return array(
            'nama_prestasi' => trim((string) $this->input->post('nama_prestasi', TRUE)),
            'nama_siswa' => trim((string) $this->input->post('nama_siswa', TRUE)),
            'kelas' => trim((string) $this->input->post('kelas', TRUE)),
            'tingkat' => trim((string) $this->input->post('tingkat', TRUE)),
            'juara' => trim((string) $this->input->post('juara', TRUE)),
            'penyelenggara' => trim((string) $this->input->post('penyelenggara', TRUE)),
            'tanggal' => $this->input->post('tanggal', TRUE),
            'deskripsi' => trim((string) $this->input->post('deskripsi', TRUE))
        );
    }

    private function upload_foto()
    {
        if (empty($_FILES['foto']['name'])) {
            return NULL;
        }

        $upload_path = FCPATH . 'uploads/prestasi/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
            $this->session->set_flashdata('error', 'Folder upload prestasi tidak dapat dibuat.');
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
}
