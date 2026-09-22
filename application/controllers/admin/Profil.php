<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'Profil Sekolah';
        $data['profil'] = $this->db->get('profil')->row();

        $this->load->view('admin/profil/index', $data);
    }

    public function update()
    {
        $profil = $this->db->get('profil')->row();
        if (!$profil) {
            $this->session->set_flashdata('error', 'Data profil belum tersedia.');
            redirect('admin/profil');
        }

        $email = trim((string) $this->input->post('email', TRUE));
        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('error', 'Format email tidak valid.');
            redirect('admin/profil');
        }

        $data = array(
            'nama_sekolah'    => trim((string) $this->input->post('nama_sekolah', TRUE)),
            'npsn'            => $this->input->post('npsn', TRUE),
            'nss'             => $this->input->post('nss', TRUE),
            'alamat'          => $this->input->post('alamat', TRUE),
            'desa'            => $this->input->post('desa', TRUE),
            'kecamatan'       => $this->input->post('kecamatan', TRUE),
            'kabupaten'       => $this->input->post('kabupaten', TRUE),
            'provinsi'        => $this->input->post('provinsi', TRUE),
            'kode_pos'        => $this->input->post('kode_pos', TRUE),
            'telepon'         => $this->input->post('telepon', TRUE),
            'email'           => $email,
            'website'         => $this->input->post('website', TRUE),
            'sejarah'         => $this->input->post('sejarah', TRUE),
            'visi'            => $this->input->post('visi', TRUE),
            'misi'            => $this->input->post('misi', TRUE),
            'sambutan_kepala' => $this->input->post('sambutan_kepala', TRUE),
            'nama_kepala'     => $this->input->post('nama_kepala', TRUE),
            'updated_at'      => date('Y-m-d H:i:s')
        );

        $foto_kepala = $this->upload_foto_kepala();
        if ($foto_kepala === FALSE) {
            redirect('admin/profil');
        }
        if ($foto_kepala !== NULL) {
            $data['foto_kepala'] = $foto_kepala;
        }

        $this->db->where('id', (int) $profil->id)->update('profil', $data);

        if ($foto_kepala !== NULL && !empty($profil->foto_kepala)) {
            $this->hapus_foto_kepala($profil->foto_kepala);
        }

        $this->session->set_flashdata('success', 'Profil sekolah berhasil diperbarui.');
        redirect('admin/profil');
    }

    private function upload_foto_kepala()
    {
        if (empty($_FILES['foto_kepala']['name'])) {
            return NULL;
        }

        $upload_path = FCPATH . 'assets/img/kepala/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
            $this->session->set_flashdata('error', 'Folder upload foto kepala sekolah tidak dapat dibuat.');
            return FALSE;
        }

        $this->load->library('upload');
        $this->upload->initialize(array(
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp|avif',
            'max_size' => 2048,
            'encrypt_name' => TRUE
        ));

        if (!$this->upload->do_upload('foto_kepala')) {
            $this->session->set_flashdata('error', strip_tags($this->upload->display_errors('', '')));
            return FALSE;
        }

        return 'kepala/' . $this->upload->data('file_name');
    }

    private function hapus_foto_kepala($foto)
    {
        if (!$foto || strpos($foto, 'kepala/') !== 0) {
            return;
        }

        $file = FCPATH . 'assets/img/' . $foto;
        if (is_file($file)) {
            unlink($file);
        }
    }
}
