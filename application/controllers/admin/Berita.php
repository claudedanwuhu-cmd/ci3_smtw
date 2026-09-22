<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'Berita';
        $data['berita'] = $this->db
            ->select('berita.*, kategori_berita.nama AS kategori')
            ->from('berita')
            ->join('kategori_berita', 'kategori_berita.id = berita.kategori_id', 'left')
            ->order_by('berita.id', 'DESC')
            ->get()
            ->result();

        $this->load->view('admin/berita/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Berita';
        $data['kategori'] = $this->db->order_by('nama', 'ASC')->get('kategori_berita')->result();

        $this->load->view('admin/berita/tambah', $data);
    }

    public function simpan()
    {
        $judul = $this->input->post('judul', TRUE);
        $thumbnail = $this->upload_thumbnail();
        if ($thumbnail === FALSE) {
            redirect('admin/berita/tambah');
        }

        $kategori_id = $this->normalise_kategori_id($this->input->post('kategori_id', TRUE));

        $data = array(
            'kategori_id' => $kategori_id,
            'user_id'     => $this->session->userdata('user_id'),
            'judul'       => $judul,
            'slug'        => url_title(strtolower($judul), 'dash', TRUE),
            'thumbnail'   => $thumbnail,
            'isi'         => $this->input->post('isi', TRUE),
            'tanggal'     => $this->input->post('tanggal', TRUE),
            'status'      => $this->input->post('status', TRUE),
            'views'       => 0,
            'created_at'  => date('Y-m-d H:i:s')
        );

        $this->db->insert('berita', $data);

        $this->session->set_flashdata('success', 'Berita berhasil ditambahkan.');
        redirect('admin/berita');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Berita';
        $data['berita'] = $this->db->where('id', $id)->get('berita')->row();

        if (!$data['berita']) {
            show_404();
        }

        $data['kategori'] = $this->db->order_by('nama', 'ASC')->get('kategori_berita')->result();

        $this->load->view('admin/berita/edit', $data);
    }

    public function update($id)
    {
        $judul = $this->input->post('judul', TRUE);
        $berita = $this->db->where('id', (int) $id)->get('berita')->row();
        if (!$berita) {
            show_404();
        }

        $thumbnail = $this->upload_thumbnail();
        if ($thumbnail === FALSE) {
            redirect('admin/berita/edit/' . $id);
        }

        $kategori_id = $this->normalise_kategori_id($this->input->post('kategori_id', TRUE));

        $data = array(
            'kategori_id' => $kategori_id,
            'judul'       => $judul,
            'slug'        => url_title(strtolower($judul), 'dash', TRUE),
            'thumbnail'   => $thumbnail !== NULL ? $thumbnail : $berita->thumbnail,
            'isi'         => $this->input->post('isi', TRUE),
            'tanggal'     => $this->input->post('tanggal', TRUE),
            'status'      => $this->input->post('status', TRUE),
            'updated_at'  => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $id)->update('berita', $data);

        if ($thumbnail !== NULL) {
            $this->hapus_thumbnail($berita->thumbnail);
        }

        $this->session->set_flashdata('success', 'Berita berhasil diperbarui.');
        redirect('admin/berita');
    }

    public function hapus($id)
    {
        $berita = $this->db->where('id', (int) $id)->get('berita')->row();
        $this->db->where('id', $id)->delete('berita');

        if ($berita) {
            $this->hapus_thumbnail($berita->thumbnail);
        }

        $this->session->set_flashdata('success', 'Berita berhasil dihapus.');
        redirect('admin/berita');
    }

    private function upload_thumbnail()
    {
        if (empty($_FILES['thumbnail']['name'])) {
            return NULL;
        }

        $upload_path = FCPATH . 'assets/img/berita/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
            $this->session->set_flashdata('error', 'Folder upload thumbnail tidak dapat dibuat.');
            return FALSE;
        }

        $this->load->library('upload');
        $this->upload->initialize(array(
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp|avif',
            'max_size' => 10240,
            'encrypt_name' => TRUE
        ));

        if (!$this->upload->do_upload('thumbnail')) {
            $this->session->set_flashdata('error', strip_tags($this->upload->display_errors('', '')));
            return FALSE;
        }

        return 'berita/' . $this->upload->data('file_name');
    }

    private function hapus_thumbnail($thumbnail)
    {
        if (!$thumbnail || strpos($thumbnail, 'berita/') !== 0) {
            return;
        }

        $file = FCPATH . 'assets/img/' . $thumbnail;
        if (is_file($file)) {
            unlink($file);
        }
    }

    private function normalise_kategori_id($kategori_id)
    {
        if ($kategori_id === '' || !ctype_digit((string) $kategori_id)) {
            return NULL;
        }

        $kategori_id = (int) $kategori_id;
        return $this->db->where('id', $kategori_id)->count_all_results('kategori_berita') > 0
            ? $kategori_id
            : NULL;
    }
}
