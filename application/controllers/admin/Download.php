<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends Admin_Controller
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
        $data['title'] = 'Download';
        $data['download'] = $this->db->order_by('id', 'DESC')->get('download')->result();

        $this->load->view('admin/download/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah File';
        $this->load->view('admin/download/tambah', $data);
    }

    public function simpan()
    {
        $file = $this->upload_file(TRUE);
        if ($file === FALSE) {
            redirect('admin/download/tambah');
        }

        $data = array(
            'judul' => trim((string) $this->input->post('judul', TRUE)),
            'kategori' => trim((string) $this->input->post('kategori', TRUE)),
            'file' => $file,
            'tanggal' => $this->input->post('tanggal', TRUE),
            'keterangan' => trim((string) $this->input->post('keterangan', TRUE)),
            'user_id' => $this->session->userdata('user_id'),
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('download', $data);

        $this->session->set_flashdata('success', 'File berhasil ditambahkan.');
        redirect('admin/download');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit File';
        $data['download'] = $this->db->where('id', $id)->get('download')->row();

        if (!$data['download']) {
            show_404();
        }

        $this->load->view('admin/download/edit', $data);
    }

    public function update($id)
    {
        $download = $this->db->where('id', (int) $id)->get('download')->row();
        if (!$download) {
            show_404();
        }

        $file = $this->upload_file(FALSE);
        if ($file === FALSE) {
            redirect('admin/download/edit/' . $id);
        }

        $data = array(
            'judul' => trim((string) $this->input->post('judul', TRUE)),
            'kategori' => trim((string) $this->input->post('kategori', TRUE)),
            'file' => $file !== NULL ? $file : $download->file,
            'tanggal' => $this->input->post('tanggal', TRUE),
            'keterangan' => trim((string) $this->input->post('keterangan', TRUE)),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $id)->update('download', $data);

        if ($file !== NULL) {
            $this->hapus_file($download->file);
        }

        $this->session->set_flashdata('success', 'File berhasil diperbarui.');
        redirect('admin/download');
    }

    public function hapus($id)
    {
        $download = $this->db->where('id', (int) $id)->get('download')->row();
        $this->db->where('id', $id)->delete('download');

        if ($download) {
            $this->hapus_file($download->file);
        }

        $this->session->set_flashdata('success', 'File berhasil dihapus.');
        redirect('admin/download');
    }

    private function upload_file($required = TRUE)
    {
        if (empty($_FILES['file']['name'])) {
            if ($required) {
                $this->session->set_flashdata('error', 'File wajib dipilih.');
                return FALSE;
            }
            return NULL;
        }

        $upload_path = FCPATH . 'assets/uploads/download/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
            $this->session->set_flashdata('error', 'Folder upload download tidak dapat dibuat.');
            return FALSE;
        }

        $this->load->library('upload');
        $this->upload->initialize(array(
            'upload_path' => $upload_path,
            'allowed_types' => 'pdf|doc|docx|xls|xlsx|zip',
            'max_size' => 10240,
            'encrypt_name' => TRUE
        ));

        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata('error', strip_tags($this->upload->display_errors('', '')));
            return FALSE;
        }

        return $this->upload->data('file_name');
    }

    private function hapus_file($file)
    {
        if (!$file || strpos($file, '/') !== FALSE || strpos($file, '\\') !== FALSE) {
            return;
        }

        $path = FCPATH . 'assets/uploads/download/' . $file;
        if (is_file($path)) {
            unlink($path);
        }
    }

    private function ensure_table()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `download` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `judul` VARCHAR(255) NOT NULL,
            `kategori` VARCHAR(100) NULL,
            `file` VARCHAR(255) NOT NULL,
            `tanggal` DATE NULL,
            `keterangan` TEXT NULL,
            `user_id` INT UNSIGNED NULL,
            `created_at` DATETIME NULL,
            `updated_at` DATETIME NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $columns = $this->db->query("SHOW COLUMNS FROM `download`")->result_array();
        $has_updated_at = FALSE;

        foreach ($columns as $column) {
            if (strtolower((string) $column['Field']) === 'updated_at') {
                $has_updated_at = TRUE;
                break;
            }
        }

        if (!$has_updated_at) {
            $this->db->query("ALTER TABLE `download` ADD COLUMN `updated_at` DATETIME NULL AFTER `created_at`");
        }
    }
}
