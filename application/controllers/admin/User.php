<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form'));

        $this->hanya_admin();
    }

    public function index()
    {
        $data['title'] = 'Manajemen User';
        $data['users'] = $this->db->order_by('id', 'DESC')->get('users')->result();

        $this->load->view('admin/user/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah User';
        $this->load->view('admin/user/tambah', $data);
    }

    public function simpan()
    {
        $data = $this->validated_user_data();
        $password = trim((string) $this->input->post('password', TRUE));

        if ($password === '') {
            $this->session->set_flashdata('error', 'Password wajib diisi.');
            redirect('admin/user/tambah');
        }

        if ($this->username_exists($data['username'])) {
            $this->session->set_flashdata('error', 'Username sudah digunakan.');
            redirect('admin/user/tambah');
        }

        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d H:i:s');

        if (!$this->db->insert('users', $data)) {
            $this->session->set_flashdata('error', 'User gagal ditambahkan.');
            redirect('admin/user/tambah');
        }

        $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
        redirect('admin/user');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit User';
        $data['user'] = $this->db->where('id', $id)->get('users')->row();

        if (!$data['user']) {
            show_404();
        }

        $this->load->view('admin/user/edit', $data);
    }

    public function update($id)
    {
        $user = $this->db->where('id', (int) $id)->get('users')->row();

        if (!$user) {
            show_404();
        }

        $data = $this->validated_user_data();

        if ($this->username_exists($data['username'], $id)) {
            $this->session->set_flashdata('error', 'Username sudah digunakan.');
            redirect('admin/user/edit/' . $id);
        }

        if ((int) $id === (int) $this->session->userdata('user_id')) {
            $data['role'] = $user->role;
            $data['status'] = $user->status;
        }

        $password = trim((string) $this->input->post('password', TRUE));
        if ($password !== '') {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if (!$this->db->where('id', (int) $id)->update('users', $data)) {
            $this->session->set_flashdata('error', 'User gagal diperbarui.');
            redirect('admin/user/edit/' . $id);
        }

        if ((int) $id === (int) $this->session->userdata('user_id')) {
            $this->session->set_userdata(array(
                'nama' => $data['nama'],
                'username' => $data['username'],
                'foto' => $data['foto']
            ));
        }

        $this->session->set_flashdata('success', 'User berhasil diperbarui.');
        redirect('admin/user');
    }

    public function hapus($id)
    {
        if ((int) $id === (int) $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
            redirect('admin/user');
        }

        if (!$this->db->where('id', (int) $id)->delete('users')) {
            $this->session->set_flashdata('error', 'User gagal dihapus.');
            redirect('admin/user');
        }

        $this->session->set_flashdata('success', 'User berhasil dihapus.');
        redirect('admin/user');
    }

    private function validated_user_data()
    {
        $nama = trim((string) $this->input->post('nama', TRUE));
        $username = trim((string) $this->input->post('username', TRUE));

        if ($nama === '' || $username === '') {
            $this->session->set_flashdata('error', 'Nama dan username wajib diisi.');
            redirect('admin/user');
        }

        $role = $this->input->post('role', TRUE);
        $status = $this->input->post('status', TRUE);

        if (!in_array($role, array('admin', 'petugas'), TRUE)) {
            $role = 'petugas';
        }

        if (!in_array($status, array('aktif', 'nonaktif'), TRUE)) {
            $status = 'aktif';
        }

        return array(
            'nama' => $nama,
            'username' => $username,
            'role' => $role,
            'status' => $status,
            'foto' => trim((string) $this->input->post('foto', TRUE))
        );
    }

    private function username_exists($username, $except_id = NULL)
    {
        $this->db->where('username', $username);

        if ($except_id !== NULL) {
            $this->db->where('id !=', (int) $except_id);
        }

        return $this->db->count_all_results('users') > 0;
    }
}
