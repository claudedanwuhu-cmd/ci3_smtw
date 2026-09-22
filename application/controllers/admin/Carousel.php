<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carousel extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
        $this->ensure_table();
    }

    public function index()
    {
        $data['title'] = 'Carousel Beranda';
        $data['carousel'] = $this->db->order_by('urutan', 'ASC')->order_by('id', 'DESC')->get('carousel')->result();

        $this->load->view('admin/carousel/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Carousel';
        $this->load->view('admin/carousel/tambah', $data);
    }

    public function simpan()
    {
        $gambar = $this->upload_gambar();
        if ($gambar === FALSE) {
            redirect('admin/carousel/tambah');
        }

        $this->db->insert('carousel', array(
            'judul' => trim((string) $this->input->post('judul', TRUE)),
            'deskripsi' => trim((string) $this->input->post('deskripsi', TRUE)),
            'tombol' => trim((string) $this->input->post('tombol', TRUE)),
            'link' => trim((string) $this->input->post('link', TRUE)),
            'gambar' => $gambar,
            'urutan' => (int) $this->input->post('urutan', TRUE),
            'status' => $this->input->post('status', TRUE) === 'nonaktif' ? 'nonaktif' : 'aktif',
            'created_at' => date('Y-m-d H:i:s')
        ));

        $this->session->set_flashdata('success', 'Carousel berhasil ditambahkan.');
        redirect('admin/carousel');
    }

    public function edit($id)
    {
        $data['carousel'] = $this->db->where('id', (int) $id)->get('carousel')->row();
        if (!$data['carousel']) {
            show_404();
        }

        $data['title'] = 'Edit Carousel';
        $this->load->view('admin/carousel/edit', $data);
    }

    public function update($id)
    {
        $carousel = $this->db->where('id', (int) $id)->get('carousel')->row();
        if (!$carousel) {
            show_404();
        }

        $gambar = $this->upload_gambar();
        if ($gambar === FALSE) {
            redirect('admin/carousel/edit/' . $id);
        }

        $data = array(
            'judul' => trim((string) $this->input->post('judul', TRUE)),
            'deskripsi' => trim((string) $this->input->post('deskripsi', TRUE)),
            'tombol' => trim((string) $this->input->post('tombol', TRUE)),
            'link' => trim((string) $this->input->post('link', TRUE)),
            'urutan' => (int) $this->input->post('urutan', TRUE),
            'status' => $this->input->post('status', TRUE) === 'nonaktif' ? 'nonaktif' : 'aktif',
            'updated_at' => date('Y-m-d H:i:s')
        );

        if ($gambar !== NULL) {
            $data['gambar'] = $gambar;
        }

        $this->db->where('id', (int) $id)->update('carousel', $data);
        if ($gambar !== NULL) {
            $this->hapus_gambar($carousel->gambar);
        }

        $this->session->set_flashdata('success', 'Carousel berhasil diperbarui.');
        redirect('admin/carousel');
    }

    public function hapus($id)
    {
        $carousel = $this->db->where('id', (int) $id)->get('carousel')->row();
        if ($carousel) {
            $this->db->where('id', (int) $id)->delete('carousel');
            $this->hapus_gambar($carousel->gambar);
        }

        $this->session->set_flashdata('success', 'Carousel berhasil dihapus.');
        redirect('admin/carousel');
    }

    private function upload_gambar()
    {
        if (empty($_FILES['gambar']['name'])) {
            return NULL;
        }

        $upload_path = FCPATH . 'assets/img/carousel/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
            $this->session->set_flashdata('error', 'Folder upload carousel tidak dapat dibuat.');
            return FALSE;
        }

        $this->load->library('upload');
        $this->upload->initialize(array(
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp|avif',
            'max_size' => 10240,
            'encrypt_name' => TRUE
        ));

        if (!$this->upload->do_upload('gambar')) {
            $this->session->set_flashdata('error', strip_tags($this->upload->display_errors('', '')));
            return FALSE;
        }

        return 'carousel/' . $this->upload->data('file_name');
    }

    private function hapus_gambar($gambar)
    {
        if (!$gambar || strpos($gambar, 'carousel/') !== 0) {
            return;
        }

        $file = FCPATH . 'assets/img/' . $gambar;
        if (is_file($file)) {
            unlink($file);
        }
    }

    private function ensure_table()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `carousel` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `judul` VARCHAR(255) NOT NULL,
            `deskripsi` TEXT NULL,
            `tombol` VARCHAR(100) NULL,
            `link` VARCHAR(255) NULL,
            `gambar` VARCHAR(255) NOT NULL,
            `urutan` INT NOT NULL DEFAULT 0,
            `status` ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif',
            `created_at` DATETIME NULL,
            `updated_at` DATETIME NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    }
}