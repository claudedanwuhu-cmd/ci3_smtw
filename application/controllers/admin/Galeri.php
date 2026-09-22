<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'Galeri';
        $data['album'] = $this->db->order_by('tanggal', 'DESC')->get('album_galeri')->result();

        $this->load->view('admin/galeri/index', $data);
    }

    public function album_tambah()
    {
        $data['title'] = 'Tambah Album';
        $this->load->view('admin/galeri/album_tambah', $data);
    }

    public function album_simpan()
    {
        $data = array(
            'nama_album' => trim((string) $this->input->post('nama_album', TRUE)),
            'deskripsi' => trim((string) $this->input->post('deskripsi', TRUE)),
            'tanggal' => $this->input->post('tanggal', TRUE)
        );

        $this->db->insert('album_galeri', $data);
        redirect('admin/galeri');
    }

    public function album_hapus($id)
    {
        $foto = $this->db->where('album_id', (int) $id)->get('galeri')->result();
        foreach ($foto as $item) {
            $this->hapus_foto($item->foto);
        }
        $this->db->where('album_id', (int) $id)->delete('galeri');
        $this->db->where('id', $id)->delete('album_galeri');
        redirect('admin/galeri');
    }

    public function album_edit($id)
    {
        $data['title'] = 'Edit Album';
        $data['album'] = $this->db->where('id', (int) $id)->get('album_galeri')->row();
        if (!$data['album']) {
            show_404();
        }
        $this->load->view('admin/galeri/album_edit', $data);
    }

    public function album_update($id)
    {
        $album = $this->db->where('id', (int) $id)->get('album_galeri')->row();
        if (!$album) {
            show_404();
        }
        $this->db->where('id', (int) $id)->update('album_galeri', array(
            'nama_album' => trim((string) $this->input->post('nama_album', TRUE)),
            'deskripsi' => trim((string) $this->input->post('deskripsi', TRUE)),
            'tanggal' => $this->input->post('tanggal', TRUE)
        ));
        $this->session->set_flashdata('success', 'Album berhasil diperbarui.');
        redirect('admin/galeri');
    }

    public function foto($album_id)
    {
        $data['title'] = 'Foto Galeri';
        $data['album'] = $this->db->where('id', $album_id)->get('album_galeri')->row();

        if (!$data['album']) {
            show_404();
        }

        $data['foto'] = $this->db->where('album_id', $album_id)->order_by('id', 'DESC')->get('galeri')->result();

        $this->load->view('admin/galeri/foto', $data);
    }

    public function foto_tambah($album_id)
    {
        $data['title'] = 'Tambah Foto';
        $data['album'] = $this->db->where('id', $album_id)->get('album_galeri')->row();

        if (!$data['album']) {
            show_404();
        }

        $this->load->view('admin/galeri/foto_tambah', $data);
    }

    public function foto_simpan()
    {
        $album_id = (int) $this->input->post('album_id', TRUE);
        $foto = $this->upload_foto();
        if ($foto === FALSE) {
            redirect('admin/galeri/foto_tambah/' . $album_id);
        }

        $data = array(
            'album_id' => $album_id,
            'judul' => trim((string) $this->input->post('judul', TRUE)),
            'foto' => $foto,
            'deskripsi' => trim((string) $this->input->post('deskripsi', TRUE))
        );

        $this->db->insert('galeri', $data);

        redirect('admin/galeri/foto/' . $data['album_id']);
    }

    public function foto_hapus($id, $album_id)
    {
        $foto = $this->db->where('id', (int) $id)->get('galeri')->row();
        $this->db->where('id', $id)->delete('galeri');

        if ($foto) {
            $this->hapus_foto($foto->foto);
        }

        redirect('admin/galeri/foto/' . $album_id);
    }

    public function foto_edit($id, $album_id)
    {
        $data['title'] = 'Edit Foto';
        $data['album'] = $this->db->where('id', (int) $album_id)->get('album_galeri')->row();
        $data['foto'] = $this->db->where('id', (int) $id)->where('album_id', (int) $album_id)->get('galeri')->row();
        if (!$data['album'] || !$data['foto']) {
            show_404();
        }
        $this->load->view('admin/galeri/foto_edit', $data);
    }

    public function foto_update($id, $album_id)
    {
        $foto_lama = $this->db->where('id', (int) $id)->where('album_id', (int) $album_id)->get('galeri')->row();
        if (!$foto_lama) {
            show_404();
        }
        $foto_baru = $this->upload_foto(TRUE);
        if ($foto_baru === FALSE) {
            redirect('admin/galeri/foto_edit/' . $id . '/' . $album_id);
        }
        $data = array(
            'judul' => trim((string) $this->input->post('judul', TRUE)),
            'deskripsi' => trim((string) $this->input->post('deskripsi', TRUE))
        );
        if ($foto_baru !== NULL) {
            $data['foto'] = $foto_baru;
        }
        $this->db->where('id', (int) $id)->update('galeri', $data);
        if ($foto_baru !== NULL) {
            $this->hapus_foto($foto_lama->foto);
        }
        $this->session->set_flashdata('success', 'Foto berhasil diperbarui.');
        redirect('admin/galeri/foto/' . $album_id);
    }

    private function upload_foto($optional = FALSE)
    {
        if (empty($_FILES['foto']['name'])) {
            if ($optional) {
                return NULL;
            }
            $this->session->set_flashdata('error', 'Foto galeri wajib dipilih.');
            return FALSE;
        }

        $upload_path = FCPATH . 'assets/img/galeri/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
            $this->session->set_flashdata('error', 'Folder upload galeri tidak dapat dibuat.');
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

        $file = FCPATH . 'assets/img/galeri/' . $foto;
        if (is_file($file)) {
            unlink($file);
        }
    }
}
